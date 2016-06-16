					}

					fd1[session_id] = open( logfilename, O_WRONLY );
					fd2[session_id] = open( replayfilename, O_WRONLY );

					if( fd1[session_id] < 0 )
					{
						//  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
						perror( logfilename );
						exit( -1 );
					}

					if( fd2[session_id] < 0 )
					{
						//  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
						perror( replayfilename );
						exit( -1 );
					}
					mysql_init(&my_connection[session_id]);
					if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
					{
						//printf("Connection DB success\n");
					}
					else
					{
						printf("Connect DB Fail\n");
					}
					sprintf(sql_query[session_id],"insert into sessions values (NULL,'%s','%s','telnet','%s',now(),now(),'%s','0',NULL,0,NULL,0,0,0)\n",sstr,cstr,user,radius_username);
					if(mysql_query(&my_connection[session_id],sql_query[session_id]))
					{
						printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
						exit(0);
					}
					bzero(sql_query[session_id],string_length);
					sprintf(sql_query[session_id],"select last_insert_id()");
					if(mysql_query(&my_connection[session_id],sql_query[session_id]))
					{
						printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
						exit(0);
					}
					my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
					if(my_res_ptr[session_id])
					{
						while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
						{
							sid[session_id]=atoi(my_sqlrow[session_id][0]);
						}
					}
					else
					{
						exit(0);
					}
				}

				if( mitm_channel_request[index].type == SSH_CMSG_EXEC_CMD )
				{
					if( strcmp( &mitm_channel_request[index].data[4], "/usr/local/libexec/sftp-server" ) == 0 )
					{
						//channel_mode
						session_channel_mode[0] = SFTP_MODE;

						if( sql_conn )
						{
							snprintf( buf, sizeof( buf ),
									"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
									VALUES('%s','%s','%s','%s','%s',now())",
									cstr, sstr, audit_address, radius_username, ssh1_user );

							/* Insert success */
							if( !mysql_query( sql_conn, buf ) )
							{
								if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
								{
									res_ptr = mysql_use_result( sql_conn );

									if( res_ptr )
									{
										while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
										{
											last_insert_id[0] = atoi( sqlrow[0] );
										}
									}
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
							else
							{
								if( mysql_errno( sql_conn ) )
								{
									printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
								}
							}
						}
					}
				}
			}

		}
	}

	if( conn_mode >= 5 ) original_mode_flag = 1;

	/* Check alive var */
	int select_ret = -1, check_flag = 0, keepalive_cnt = 0;
	struct timeval check_client_alive_timeout;
	extern int check_client_alive_interval;

	struct simple_packet forward2server_packet, forward2client_packet;
	int forward2server_flag = 0, forward2client_flag = 0;

	if( check_client_alive_interval == -1 ) check_client_alive_interval = 180;

	printf( "Proxy check client alive interval is %d seconds.\n", check_client_alive_interval );
	
	if( radius_username != NULL ) strcpy( radius__username, radius_username );

	for( ;; )
	{
		char *pt;

		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );

		debug( "[FREESVR-SSH-PROXY] Selecting on server side %d", getpid() );

		if( check_flag )
		{
			check_client_alive_timeout.tv_sec  = 3;
			check_client_alive_timeout.tv_usec = 0;
		}
		else
		{
			check_client_alive_timeout.tv_sec  = check_client_alive_interval;
			check_client_alive_timeout.tv_usec = 0;
		}

		if(( select_ret = select( nfd, &readtmp, NULL, NULL, &check_client_alive_timeout ) ) <= 0 )
		{
			if( select_ret == 0 )
			{
				if( compat20 )
				{
					/* Check alive to client */
					if( ++keepalive_cnt > 3 )
						cleanup_exit( 255 );

					/* Send check message */
					packet_start( SSH2_MSG_GLOBAL_REQUEST );
					packet_put_cstring( "keepalive@openssh.com" );
					packet_put_char( 1 );
					packet_send();
					packet_write_wait();

					check_flag = 1;

					printf( "Send check alive message to client. @ %s\n", str_time( time( NULL ), NULL ) );
					/* Check alive to client */
				}

				continue;
			}

			if( errno == EINTR )
				continue;

			break;
		}

		/* Read from client and write to socketpair */
		/* Log the stream of client */
		if( FD_ISSET( cfd, &readtmp ) )
		{
			debug( "[FREESVR-SSH-PROXY] Reading from client on server side %d", getpid() );

			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == 20 || spkt.type == 30 || spkt.type == 31 || spkt.type == 32 ||
							spkt.type == 21 || spkt.type == 33 || spkt.type == 34 )
					{
						if( spkt.type == 20 )
						{
							dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
						}
					}
					/* Check alive */
					else if( spkt.type == 82 || spkt.type == 81 )
					{
						printf( "Recv echo from client, keep alive. @ %s\n", str_time( time( NULL ), NULL ) );
						keepalive_cnt = 0;
						check_flag = 0;
					}
					else
					{
						//if (writen(sp[0], &spkt, spkt.len+8) != spkt.len+8)
						//break;

						memset( &forward2server_packet, 0x00,  spkt.len + 8 );
						memcpy( &forward2server_packet, &spkt, spkt.len + 8 );
						forward2server_flag = 1;
					}
				}
				else
				{
					//if (writen(sp[0], &spkt, spkt.len+8) != spkt.len+8)
					//break;
					memset( &forward2server_packet, 0x00,  spkt.len + 8 );
					memcpy( &forward2server_packet, &spkt, spkt.len + 8 );
					forward2server_flag = 1;
				}

				/* Log SSH2 data */
				if( compat20 )
				{
					if( spkt.len >= 4 )
					{
						memcpy( &session_id, &spkt.data[0], 4 );
						session_id = ntohl( session_id );
					}

					//printf( "Session id = %d\n", session_id );
					if( show_stream )
					{
						printf( "client@%d session=%d type=%d  %d: ", getpid(), session_id, spkt.type, spkt.len );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else
								printf( " %02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );
					}

					//if ( spkt.type != 94 && spkt.type != 93 )
					//                    {
					//                    printf("client type=%d  %d: ",spkt.type, spkt.len);
					//                    for ( i = 0; i < spkt.len; i++ )
					//                    {
					//                        printf( "%02x ", (u_char)spkt.data[i] );
					//                    }
					//                    printf("\n");
					//                    }

					/* Judge this connection is ssh or scp or sftp */
					if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );

						if( packet_get_int() == 256 )
							client_is_putty = 1;
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						if( spkt.len >= 8 )
						{
							memcpy( &channel_req_str_len, &spkt.data[4], 4 );
							channel_req_str_len = ntohl( channel_req_str_len );

							if( channel_req_str_len <= spkt.len - 8 && channel_req_str_len < STRLENGTH )
							{
								memcpy( channel_req_str, &spkt.data[8], channel_req_str_len );
								channel_req_str[channel_req_str_len] = '\0';
								printf( "\nCHANNEL REQUEST:%s\n", channel_req_str );
							}
						}

						if( strcmp( channel_req_str, "shell" ) == 0 )
						{
							session_channel_mode[session_id] = SSH_MODE;

							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2_MSG_CHANNEL_REQUEST: SSH2 CONNECTION, SESSION ID = %d\n",
									str_time( time( NULL ), NULL ), cstr, sstr, session_id );
							logit( "\n%s", buf );

							/* fork perl ssh2*/
							if( !original_mode_flag )
							{
								char logfilename[256];
								char replayfilename[256];
								

								cmd[session_id]=malloc(sizeof(char)*string_length);
								inputcommandline[session_id]=malloc(sizeof(char)*string_length);
								commandline[session_id]=malloc(sizeof(char)*string_length);
								cache1[session_id]=malloc(sizeof(char)*string_length);
								cache2[session_id]=malloc(sizeof(char)*string_length);
								linebuffer[session_id]=malloc(sizeof(char)*string_length);
								sql_query[session_id]=malloc(sizeof(char)*string_length);
								p=localtime(&timep);

								sprintf(logfilename,"%s/telnet_log_%d_%d_%d_%d_%d_%d_%d",logcache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
								sprintf(replayfilename,"%s/telnet_replay_%d_%d_%d_%d_%d_%d_%d",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);

								monitor_shell_pipe_name[session_id] = ( char * )malloc( 128 );
								sprintf( monitor_shell_pipe_name[session_id], "%s/monitor_shell=%d.%d", BINPATH, getpid(), session_id );

								if(strlen(forbidden)>0)
								{
									get_pcre(forbidden,black_cmd_list,&black_cmd_num,&my_connection[session_id],my_res_ptr[session_id],&my_sqlrow[session_id],& black_or_white[session_id],sql_query[session_id]);
								}

								fd1[session_id] = open( logfilename, O_WRONLY );
								fd2[session_id] = open( replayfilename, O_WRONLY );

								if( fd1[session_id] < 0 )
								{
									//  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
									perror( logfilename );
									exit( -1 );
								}

								if( fd2[session_id] < 0 )
								{
									//  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
									perror( replayfilename );
									exit( -1 );
								}
								mysql_init(&my_connection[session_id]);
								if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
								{
									//printf("Connection DB success\n");
								}
								else
								{
									printf("Connect DB Fail\n");
								}
								sprintf(sql_query[session_id],"insert into sessions values (NULL,'%s','%s','telnet','%s',now(),now(),'%s','0',NULL,0,NULL,0,0,0)\n",sstr,cstr,user,radius_username);
								if(mysql_query(&my_connection[session_id],sql_query[session_id]))
								{
									printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
									exit(0);
								}
								bzero(sql_query[session_id],string_length);
								sprintf(sql_query[session_id],"select last_insert_id()");
								if(mysql_query(&my_connection[session_id],sql_query[session_id]))
								{
									printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
									exit(0);
								}
								my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
								if(my_res_ptr[session_id])
								{
									while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
									{
										sid[session_id]=atoi(my_sqlrow[session_id][0]);
									}
								}
								else
								{
									exit(0);
								}
							}
						}
						else if( strcmp( channel_req_str, "exec" ) == 0 )
						{
							memcpy( &exec_command_len, &spkt.data[8+channel_req_str_len+1], 4 );
							exec_command_len = ntohl( exec_command_len );
							memcpy( exec_command, &spkt.data[8+channel_req_str_len+5], exec_command_len );
							exec_command[exec_command_len] = '\0';
							printf( "%s\n", exec_command );

							if( exec_command[0] == 's' && exec_command[1] == 'c' && exec_command[2] == 'p' )
							{
								session_channel_mode[session_id] == SCP_MODE;
								snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
										"SSH2_MSG_CHANNEL_REQUEST: %s\n",
										str_time( time( NULL ), NULL ), cstr, sstr, exec_command );
								logit( "\n%s", buf );
							}
						}
						else if( strcmp( channel_req_str, "subsystem" ) == 0 ) //( spkt.data[spkt.len-1] == 'p' )
						{
							memcpy( &subsystem_name_len, &spkt.data[8+channel_req_str_len+1], 4 );
							subsystem_name_len = ntohl( subsystem_name_len );
							//if ( subsystem_name_len <= spkt.len - 9 - channel_req_str_len && subsystem_name_len < STRLENGTH )
							memcpy( subsystem_name, &spkt.data[8+channel_req_str_len+5], subsystem_name_len );
							subsystem_name[subsystem_name_len] = '\0';
							printf( "%s\n", subsystem_name );

							if( strcmp( subsystem_name, "sftp" ) == 0 )
							{
								snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
										"SSH2_MSG_CHANNEL_REQUEST: SFTP\n",
										str_time( time( NULL ), NULL ), cstr, sstr );
								logit( "\n%s", buf );

								session_channel_mode[session_id] = SFTP_MODE;

								if( sql_conn )
								{
									snprintf( buf, sizeof( buf ),
											"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
											VALUES('%s','%s','%s','%s','%s',now())",
											cstr, sstr, audit_address, radius_username, user );

									/* Insert success */
									if( !mysql_query( sql_conn, buf ) )
									{
										if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
										{
											res_ptr = mysql_use_result( sql_conn );

											if( res_ptr )
											{
												while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
												{
													last_insert_id[session_id] = atoi( sqlrow[0] );
												}
											}
										}
										else
										{
											if( mysql_errno( sql_conn ) )
											{
												printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
											}
										}
									}
									else
									{
										if( mysql_errno( sql_conn ) )
										{
											printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
										}
									}
								}
							}
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_CLOSE )
					{
						if( session_channel_mode[session_id] == SSH_MODE )
						{
							session_channel_mode[session_id] = 0;
							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2 EXIT!! SESSION ID = %d\n",
									str_time( time( NULL ), NULL ), cstr, sstr, session_id );
							logit( "\n%s", buf );

							/* kill perl ssh2*/
							if( !original_mode_flag )
							{
								close( fd1 );
								close( fd2 );
								free( inputcommandline[session_id] );
								free( commandline[session_id] );
							}
						}

						if( session_channel_mode[session_id] == SFTP_MODE )
						{
							session_channel_mode[session_id] = 0;

							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"UPDATE sftpsessions SET end=now() WHERE sid=%d",
										last_insert_id[session_id] );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									printf( "Mysql insert \"update\" command log success!\n" );
									last_insert_id[session_id] = 0;
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_REQUEST )
					{
						user = packet_get_string( NULL );
						char *service = packet_get_string( NULL );
						char *method = packet_get_string( NULL );

						debug2( "[FREESVR-SSH-PROXY] %s -> %s SSH2_MSG_USERAUTH_REQUEST: %s %s %s",
								cstr, sstr, user, service, method );

						if( strcmp( method, "password" ) == 0 )
						{
							char c = packet_get_char();
							char *pass = packet_get_string( NULL );

							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2_MSG_USERAUTH_REQUEST: %s %s %s %d %s\n",
									str_time( time( NULL ), NULL ), cstr, sstr,
									user, service, method, c, pass );
							logit( "\n%s", buf );

							if( logf != NULL )
							{
								fprintf( logf, "%s\n", buf );
								fflush( logf );
							}
						}

						if( strcmp( method, "keyboard-interactive" ) == 0 )
						{
							log_info_response = 1;
							info_response_user = strdup( user );
						}
					}
					else if( log_info_response && spkt.type == SSH2_MSG_USERAUTH_INFO_RESPONSE )
					{
						u_int a = packet_get_int();
						char *pass = packet_get_string( NULL );

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2_MSG_USERAUTH_INFO_RESPONSE: (%s) %s\n",
								str_time( time( NULL ), NULL ), cstr, sstr,
								info_response_user, pass );

						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}

						log_info_response = 0;

						if( info_response_user )
						{
							free( info_response_user );
							info_response_user = NULL;
						}
					}

					/* Log the stream from client */
					else if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						//                        if ((src_data > 0) && (spkt.len >= 8))
						//                            writen(src_data, &spkt.data[8], spkt.len-8);
						if( conn_mode == 5 ) 
						{
							ret = jump_scan_command( &spkt.data[8], spkt.len - 8, radius__username, sourceip, cfd, sp[0], client_is_putty ? 256 :0, session_id, &forward2server_packet );
						}

						if( session_channel_mode[session_id] == SSH_MODE )
						{
							/* auto jump */
							ret = jump_scan_command( &spkt.data[8], spkt.len - 8, radius__username, sourceip, cfd, sp[0], client_is_putty ? 256 :0, session_id, &forward2server_packet );

							/* write to perl ssh2 client */
							if( !original_mode_flag )
							{
								char childargv[30];
								sprintf( childargv, "logssh=%d.%d", getpid(), session_id );
								//gettimeofday(&ts1, NULL);
								//telnet_writelogfile2( &spkt.data[8], spkt.len - 8, monitor_shell_pipe_name[session_id],
								telnet_writelogfile2( &forward2server_packet.data[8], forward2server_packet.len - 8, monitor_shell_pipe_name[session_id],
										winopenfile[session_id], fd1[session_id], fd2[session_id],
										inputcommandline[session_id], commandline[session_id], &waitforline[session_id],black_cmd_list,&black_cmd_num);
								//gettimeofday(&ts2, NULL);
							}
						}

						if( session_channel_mode[session_id] == SFTP_MODE )
						{
							/* Skip init message */
							if( client_first_init_flag[session_id] )
							{
								client_first_init_flag[session_id] = 0;
							}
							else
							{
								/* if buffer is larger than spkt.size */
								if( new_client_buffer_flag[session_id] )
								{
									u_int buflen;
									copy_client_buffer_size[session_id] = 0;
									csp[session_id] = 8;

									while( copy_client_buffer_size[session_id] < spkt.len - 8 )
									{
										memcpy( &buflen, &spkt.data[csp[session_id]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_client_type[session_id], &spkt.data[csp[session_id] + 4], 1 );
										memcpy( &transfer_client_id[session_id], &spkt.data[csp[session_id] + 5], 4 );
										transfer_client_id[session_id] = ntohl( transfer_client_id[session_id] );

										client_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
										client_buf[session_id]->buf    = ( u_char * )malloc( buflen );
										client_buf[session_id]->alloc  = buflen;
										client_buf[session_id]->offset = 0;
										client_buf[session_id]->end = 0;

										/* Only a part of a new buffer */
										if( copy_client_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
										{
											int copy_size = spkt.len - 8 - copy_client_buffer_size[session_id] - 4;
											memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], copy_size );
											client_buf[session_id]->end += copy_size;

											copy_client_buffer_size[session_id] += ( copy_size + 4 );

											new_client_buffer_flag[session_id] = 0;
										}
										else
										{
											memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], buflen );
											client_buf[session_id]->end += buflen;

											copy_client_buffer_size[session_id] += ( buflen + 4 );
											csp[session_id] += ( buflen + 4 );

											new_client_buffer_flag[session_id] = 1;
											/* do */
											store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );
										}
									}
								}
								else
								{
									if( client_buf[session_id]->end + spkt.len - 8 > client_buf[session_id]->alloc )
									{
										copy_client_buffer_size[session_id] = client_buf[session_id]->alloc - client_buf[session_id]->end;
										csp[session_id] = 8 + client_buf[session_id]->alloc - client_buf[session_id]->end;

										memcpy( client_buf[session_id]->buf + client_buf[session_id]->end, &spkt.data[8],
												client_buf[session_id]->alloc - client_buf[session_id]->end );
										client_buf[session_id]->end = client_buf[session_id]->alloc;

										new_client_buffer_flag[session_id] = 1;
										/* do */
										store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );

										u_int buflen;

										while( copy_client_buffer_size[session_id] < spkt.len - 8 )
										{
											memcpy( &buflen, &spkt.data[csp[session_id]], 4 );
											buflen = ntohl( buflen );
											memcpy( &command_client_type[session_id], &spkt.data[csp[session_id] + 4], 1 );
											memcpy( &transfer_client_id[session_id], &spkt.data[csp[session_id] + 5], 4 );
											transfer_client_id[session_id] = ntohl( transfer_client_id[session_id] );

											client_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
											client_buf[session_id]->buf    = ( u_char * )malloc( buflen );
											client_buf[session_id]->alloc  = buflen;
											client_buf[session_id]->offset = 0;
											client_buf[session_id]->end    = 0;

											/* Only a part of a new buffer */
											if( copy_client_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
											{
												int copy_size = spkt.len - 8 - copy_client_buffer_size[session_id] - 4;
												memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], copy_size );
												client_buf[session_id]->end += copy_size;

												copy_client_buffer_size[session_id] += ( copy_size + 4 );

												new_client_buffer_flag[session_id] = 0;
											}
											else
											{
												memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], buflen );
												client_buf[session_id]->end += buflen;

												copy_client_buffer_size[session_id] += ( buflen + 4 );
												csp[session_id] += ( buflen + 4 );

												new_client_buffer_flag[session_id] = 1;
												/* do */
												store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );
											}
										}

									}
									else if( client_buf[session_id]->end + spkt.len - 8 == client_buf[session_id]->alloc )
									{
										memcpy( client_buf[session_id]->buf + client_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
										client_buf[session_id]->end += spkt.len - 8;

										new_client_buffer_flag[session_id] = 1;
										/* do */
										store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );
									}
									/* client_buf->end + spkt.len - 8 < client_buf->alloc */
									else
									{
										memcpy( client_buf[session_id]->buf + client_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
										client_buf[session_id]->end += spkt.len - 8;
									}
								}
							}
						}
					}
				}
				/* Log SSH1 data */
				else
				{
					session_id = 0;

					if( show_stream )
					{
						printf( "SSH1 client@%d type=%d len=%d: ", getpid(), spkt.type, spkt.len );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", ( u_char )spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );
					}

					/* Judge sftp mode */
					if( spkt.type == SSH_CMSG_EXEC_SHELL )
					{
						//channel_mode = SSH_MODE;
						session_channel_mode[0] = SSH_MODE;

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
								"SSH1_CMSG_EXEC_SHELL: SSH1\n",
								str_time( time( NULL ), NULL ), cstr, sstr );
						logit( "\n%s", buf );

						/* fork perl ssh1 */
						if( !original_mode_flag )
						{
							char logfilename[256];
							char replayfilename[256];
							

							cmd[session_id]=malloc(sizeof(char)*string_length);
							inputcommandline[session_id]=malloc(sizeof(char)*string_length);
							commandline[session_id]=malloc(sizeof(char)*string_length);
							cache1[session_id]=malloc(sizeof(char)*string_length);
							cache2[session_id]=malloc(sizeof(char)*string_length);
							linebuffer[session_id]=malloc(sizeof(char)*string_length);
							sql_query[session_id]=malloc(sizeof(char)*string_length);
							p=localtime(&timep);

							sprintf(logfilename,"%s/telnet_log_%d_%d_%d_%d_%d_%d_%d",logcache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
							sprintf(replayfilename,"%s/telnet_replay_%d_%d_%d_%d_%d_%d_%d",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);

							monitor_shell_pipe_name[session_id] = ( char * )malloc( 128 );
							sprintf( monitor_shell_pipe_name[session_id], "%s/monitor_shell=%d.%d", BINPATH, getpid(), session_id );

							if(strlen(forbidden)>0)
							{
								get_pcre(forbidden,black_cmd_list,&black_cmd_num,&my_connection[session_id],my_res_ptr[session_id],&my_sqlrow[session_id],& black_or_white[session_id],sql_query[session_id]);
							}

							fd1[session_id] = open( logfilename, O_WRONLY );
							fd2[session_id] = open( replayfilename, O_WRONLY );

							if( fd1[session_id] < 0 )
							{
								//  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
								perror( logfilename );
								exit( -1 );
							}

							if( fd2[session_id] < 0 )
							{
								//  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
								perror( replayfilename );
								exit( -1 );
							}
							mysql_init(&my_connection[session_id]);
							if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
							{
								//printf("Connection DB success\n");
							}
							else
							{
								printf("Connect DB Fail\n");
							}
							sprintf(sql_query[session_id],"insert into sessions values (NULL,'%s','%s','telnet','%s',now(),now(),'%s','0',NULL,0,NULL,0,0,0)\n",sstr,cstr,user,radius_username);
							if(mysql_query(&my_connection[session_id],sql_query[session_id]))
							{
								printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
								exit(0);
							}
							bzero(sql_query[session_id],string_length);
							sprintf(sql_query[session_id],"select last_insert_id()");
							if(mysql_query(&my_connection[session_id],sql_query[session_id]))
							{
								printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
								exit(0);
							}
							my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
							if(my_res_ptr[session_id])
							{
								while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
								{
									sid[session_id]=atoi(my_sqlrow[session_id][0]);
								}
							}
							else
							{
								exit(0);
							}
						}
					}

					if( spkt.type == SSH_CMSG_EXEC_CMD )
					{
						if( strcmp( &spkt.data[4], "/usr/local/libexec/sftp-server" ) == 0 )
						{
							//channel_mode
							session_channel_mode[0] = SFTP_MODE;

							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
										VALUES('%s','%s','%s','%s','%s',now())",
										cstr, sstr, audit_address, radius_username, ssh1_user );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
									{
										res_ptr = mysql_use_result( sql_conn );

										if( res_ptr )
										{
											while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
											{
												last_insert_id[0] = atoi( sqlrow[0] );
											}
										}
									}
									else
									{
										if( mysql_errno( sql_conn ) )
										{
											printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
										}
									}
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
					else if( spkt.type == SSH_CMSG_EOF || spkt.type == SSH_CMSG_EXIT_CONFIRMATION )
					{
						if( session_channel_mode[0] == SSH_MODE )
						{
							session_channel_mode[0] = 0;
							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
									"SSH1:Exit!\n",
									str_time( time( NULL ), NULL ), cstr, sstr );
							logit( "\n%s", buf );
							/* kill perl ssh1 */
						}

						if( session_channel_mode[0] == SFTP_MODE )
						{
							session_channel_mode[0] = 0;

							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"UPDATE sftpsessions SET end=now() WHERE sid=%d",
										last_insert_id[0] );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									printf( "Mysql insert \"update\" command log success!\n" );
									last_insert_id[0] = 0;
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
					else if(( spkt.type == SSH_CMSG_STDIN_DATA ) ||
							( spkt.type == SSH_SMSG_STDOUT_DATA ) ||
							( spkt.type == SSH_SMSG_STDERR_DATA ) )
					{
						//                        if (src_data > 0)
						//                            writen(src_data, &spkt.data[4], spkt.len-4);
						if( session_channel_mode[0] == SSH_MODE )
						{
							/* write to perl ssh1 client */
							if( !original_mode_flag )
							{
								telnet_writelogfile2( &spkt.data[4], spkt.len - 4, monitor_shell_pipe_name[session_id], winopenfile[session_id],
										fd1[session_id], fd2[session_id], inputcommandline[session_id], commandline[session_id],
										&waitforline[session_id],black_cmd_list,&black_cmd_num);
							}
						}

						if( session_channel_mode[0] == SFTP_MODE )
						{
							/* Skip init message, SSH1 has two buffers! */
							if( client_first_init_flag[0] > -1 )
							{
								client_first_init_flag[0] --;
							}
							else
							{
								/* if buffer is larger than spkt.size */
								if( new_client_buffer_flag[0] )
								{
									u_int buflen;
									copy_client_buffer_size[0] = 0;
									csp[0] = 4;

									while( copy_client_buffer_size[0] < spkt.len - 4 )
									{
										memcpy( &buflen, &spkt.data[csp[0]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_client_type[0], &spkt.data[csp[0] + 4], 1 );
										memcpy( &transfer_client_id[0], &spkt.data[csp[0] + 5], 4 );
										transfer_client_id[0] = ntohl( transfer_client_id[0] );

										client_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
										client_buf[0]->buf    = ( u_char * )malloc( buflen );
										client_buf[0]->alloc  = buflen;
										client_buf[0]->offset = 0;
										client_buf[0]->end    = 0;

										/* Only a part of a new buffer */
										if( copy_client_buffer_size[0] + buflen + 4 > spkt.len - 4 )
										{
											int copy_size = spkt.len - 4 - copy_client_buffer_size[0] - 4;
											memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], copy_size );
											client_buf[0]->end += copy_size;

											copy_client_buffer_size[0] += ( copy_size + 4 );

											new_client_buffer_flag[0] = 0;
										}
										else
										{
											memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], buflen );
											client_buf[0]->end += buflen;

											copy_client_buffer_size[0] += ( buflen + 4 );
											csp[0] += ( buflen + 4 );

											new_client_buffer_flag[0] = 1;
											/* do */
											store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );
										}
									}
								}
								else
								{
									if( client_buf[0]->end + spkt.len - 4 > client_buf[0]->alloc )
									{
										copy_client_buffer_size[0] = client_buf[0]->alloc - client_buf[0]->end;
										csp[0] = 4 + client_buf[0]->alloc - client_buf[0]->end;

										memcpy( client_buf[0]->buf + client_buf[0]->end, &spkt.data[4],
												client_buf[0]->alloc - client_buf[0]->end );
										client_buf[0]->end = client_buf[0]->alloc;

										new_client_buffer_flag[0] = 1;
										/* do */
										store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );

										u_int buflen;

										while( copy_client_buffer_size[0] < spkt.len - 4 )
										{
											memcpy( &buflen, &spkt.data[csp[0]], 4 );
											buflen = ntohl( buflen );
											memcpy( &command_client_type[0], &spkt.data[csp[0] + 4], 1 );
											memcpy( &transfer_client_id[0], &spkt.data[csp[0] + 5], 4 );
											transfer_client_id[0] = ntohl( transfer_client_id[0] );

											client_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
											client_buf[0]->buf    = ( u_char * )malloc( buflen );
											client_buf[0]->alloc  = buflen;
											client_buf[0]->offset = 0;
											client_buf[0]->end    = 0;

											/* Only a part of a new buffer */
											if( copy_client_buffer_size[0] + buflen + 4 > spkt.len - 4 )
											{
												int copy_size = spkt.len - 4 - copy_client_buffer_size[0] - 4;
												memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], copy_size );
												client_buf[0]->end += copy_size;

												copy_client_buffer_size[0] += ( copy_size + 4 );

												new_client_buffer_flag[0] = 0;
											}
											else
											{
												memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], buflen );
												client_buf[0]->end += buflen;

												copy_client_buffer_size[0] += ( buflen + 4 );
												csp[0] += ( buflen + 4 );

												new_client_buffer_flag[0] = 1;
												/* do */
												store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );
											}
										}

									}
									else if( client_buf[0]->end + spkt.len - 4 == client_buf[0]->alloc )
									{
										memcpy( client_buf[0]->buf + client_buf[0]->end, &spkt.data[4], spkt.len - 4 );
										client_buf[0]->end += spkt.len - 4;

										new_client_buffer_flag[0] = 1;
										/* do */
										store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );
									}
									/* client_buf->end + spkt.len - 8 < client_buf->alloc */
									else
									{
										memcpy( client_buf[0]->buf + client_buf[0]->end, &spkt.data[4], spkt.len - 4 );
										client_buf[0]->end += spkt.len - 4;
									}
								}
							}
						}
					}
					else if( spkt.type == SSH_CMSG_USER )
					{
						memset( ssh1_user, 0, sizeof( ssh1_user ) );
						memcpy( ssh1_user, &spkt.data[4], spkt.len - 4 );
						//printf( "SSH1 USER: %s\n", ssh1_user );
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
								"\nSSH_CMSG_USER: %s\n", str_time( time( NULL ), NULL ),
								cstr, sstr, &spkt.data[4] );
						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}
					}
					else if( spkt.type == SSH_CMSG_AUTH_PASSWORD )
					{
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
								"\nSSH_CMSG_AUTH_PASSWORD: %s\n", str_time( time( NULL ),
									NULL ), cstr, sstr, &spkt.data[4] );
						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}
					}
				}

				if( forward2server_flag == 1 )
				{
					forward2server_flag = 0;

					if( block_command_flag == 0 )
					{
						if( writen( sp[0], &forward2server_packet, forward2server_packet.len + 8 )
								!= forward2server_packet.len + 8 )
							break;
					}
					else
					{
						char block_command_fp[64];
						int sid;
						bzero( block_command_fp, sizeof( block_command_fp ) );
						snprintf( block_command_fp, sizeof( block_command_fp ), "/opt/freesvr/audit/gateway/log/ssh/block_%d", getpid() );
						FILE *block_fp = fopen( block_command_fp, "r" );

						if( block_fp ) fscanf( block_fp, "%d", &sid );

						fclose( block_fp );
						block_command_flag = 0;
						char block_buf[] =
						{
							0x5e, 0x00, 0x00, 0x00, 0x09, 0x00, 0x00, 0x00,
							0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01,
							0x03
						};

						packet_start( SSH2_MSG_CHANNEL_DATA );

						if( client_is_putty )
							packet_put_int( 256 );
						else
						{
							packet_put_int( sid );
							put_u32( &block_buf[8], sid );
						}

						packet_put_cstring( "\x0d\x0a Forbidden command!\x0d\x0a" );
						packet_send();
						packet_write_wait();

						if( writen( sp[0], &block_buf, 17 ) != 17 ) break;
					}
				}

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}

		/* Read from socketpair and write to client */
		/* Log the stream of server */
		if( FD_ISSET( sp[0], &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading spkt header on server side" );

			if(( n = readn( sp[0], &spkt, 8 ) ) <= 0 )
				break;

			if( spkt.len > sizeof( spkt.data ) )
			{
				fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
						spkt.len, sizeof( spkt.data ) );
			}

			debug4( "[FREESVR-SSH-PROXY] Reading %u bytes from socketpair on server side", spkt.len );

			if( spkt.len && ( n = readn( sp[0], spkt.data, spkt.len ) ) <= 0 )
				break;

			/*debug3("[FREESVR-SSH-PROXY] Got %u bytes from child process", spkt.len);
			  packet_start(spkt.type);
			  packet_put_raw(spkt.data, spkt.len);
			  packet_send();
			  packet_write_wait();*/

			memset( &forward2client_packet, 0x00,  spkt.len + 8 );
			memcpy( &forward2client_packet, &spkt, spkt.len + 8 );
			forward2client_flag = 1;

			/* Log SSH2 data
			 * TODO: No need to log data that won't appear here */
			if( compat20 )
			{
				if( spkt.len >= 4 )
				{
					memcpy( &session_id, &spkt.data[0], 4 );
					session_id = ntohl( session_id );

					if( session_trans[session_id] )
					{
						session_id = session_trans[session_id];
					}
				}

				if( session_id == 256 ) session_id = 0;

				//                printf( "Server Session id = %d\n", session_id );
				if( show_stream )
				{
					printf( "server@%d session=%d type=%d: ", getpid(), session_id, spkt.type );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( " %02x ", ( unsigned char )spkt.data[i] );
					}

					printf( "\n" );
				}

				//                                for ( i = 8; i < spkt.len; i++ )
				//                                {
				//                                    printf( "%c", (u_char)spkt.data[i] );
				//                                }
				//                                printf("\n");
				//                if ( spkt.type != 94 && spkt.type != 93 )
				//                {
				//                    printf("server type=%d  %d: ",spkt.type, spkt.len);
				//                    for ( i = 0; i < spkt.len; i++ )
				//                    {
				//                        printf( "%02x ", (u_char)spkt.data[i] );
				//                    }
				//                    printf("\n");
				//                }

				if( spkt.type == SSH2_MSG_CHANNEL_OPEN_CONFIRMATION )
				{
					int session_sid, session_cid;
					memcpy( &session_sid, &spkt.data[0], 4 );
					session_sid = ntohl( session_sid );
					memcpy( &session_cid, &spkt.data[4], 4 );
					session_cid = ntohl( session_cid );

					session_trans[session_sid] = session_cid;
				}

				if( spkt.type == SSH2_MSG_CHANNEL_CLOSE )
				{
					if( session_channel_mode[session_id] == SSH_MODE )
					{
						session_channel_mode[session_id] = 0;
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2 EXIT!! SESSION ID = %d\n",
								str_time( time( NULL ), NULL ), cstr, sstr, session_id );
						logit( "\n%s", buf );

						/* kill perl ssh2 */
						if( !original_mode_flag )
						{
							close( fd1 );
							close( fd2 );
							free( inputcommandline[session_id] );
							free( commandline[session_id] );
						}
					}

					if( session_channel_mode[session_id] == SFTP_MODE )
					{
						session_channel_mode[session_id] = 0;

						if( sql_conn )
						{
							snprintf( buf, sizeof( buf ),
									"UPDATE sftpsessions SET end=now() WHERE sid=%d",
									last_insert_id[session_id] );

							/* Insert success */
							if( !mysql_query( sql_conn, buf ) )
							{
								printf( "Mysql insert \"update\" command log success!\n" );
								last_insert_id[session_id] = 0;
							}
							else
							{
								if( mysql_errno( sql_conn ) )
								{
									printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
								}
							}
						}
					}
				}

				if( spkt.type == SSH2_MSG_USERAUTH_REQUEST )
				{
					user = packet_get_string( NULL );
					char *service = packet_get_string( NULL );
					char *method = packet_get_string( NULL );

					if( strcmp( method, "password" ) == 0 )
					{
						char c = packet_get_char();
						char *pass = packet_get_string( NULL );

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2_MSG_USERAUTH_REQUEST: %s %s %s %d %s\n",
								str_time( time( NULL ), NULL ), cstr, sstr,
								user, service, method, c, pass );
						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}
					}
				}
				else if( spkt.type == SSH2_MSG_CHANNEL_DATA )
				{
					//                    if ((dst_data > 0) && (spkt.len >= 8))
					//                        writen(dst_data, &spkt.data[8], spkt.len-8);

					if( session_channel_mode[session_id] == SSH_MODE )
					{
						/* write to perl ssh2 server */
						//if ((dst_data > 0) && (spkt.len >= 8))
						if( !original_mode_flag )
						{
							telnet_writelogfile( &spkt.data[8], spkt.len - 8, monitor_shell_pipe_name[session_id],
									fd1[session_id], fd2[session_id], fd3[session_id], inputcommandline[session_id],
									commandline[session_id], &waitforline[session_id] );
						}

					}

					if( session_channel_mode[session_id] == SFTP_MODE )
					{
						if( server_first_init_flag[session_id] )
						{
							server_first_init_flag[session_id] = 0;
						}
						else
						{
							/* if buffer is larger than spkt.size */
							if( new_server_buffer_flag[session_id] )
							{
								u_int buflen;
								copy_server_buffer_size[session_id] = 0;
								ssp[session_id] = 8;

								while( copy_server_buffer_size[session_id] < spkt.len - 8 )
								{
									memcpy( &buflen, &spkt.data[ssp[session_id]], 4 );
									buflen = ntohl( buflen );
									memcpy( &command_server_type[session_id], &spkt.data[ssp[session_id] + 4], 1 );
									memcpy( &transfer_server_id[session_id], &spkt.data[ssp[session_id] + 5], 4 );
									transfer_server_id[session_id] = ntohl( transfer_server_id[session_id] );

									server_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
									server_buf[session_id]->buf    = ( u_char * )malloc( buflen );
									server_buf[session_id]->alloc  = buflen;
									server_buf[session_id]->offset = 0;
									server_buf[session_id]->end    = 0;

									/* Only a part of a new buffer */
									if( copy_server_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
									{
										int copy_size = spkt.len - 8 - copy_server_buffer_size[session_id] - 4;
										memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], copy_size );
										server_buf[session_id]->end += copy_size;

										copy_server_buffer_size[session_id] += ( copy_size + 4 );

										new_server_buffer_flag[session_id] = 0;
									}
									else
									{
										memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], buflen );
										server_buf[session_id]->end += buflen;

										copy_server_buffer_size[session_id] += ( buflen + 4 );
										ssp[session_id] += ( buflen + 4 );

										new_server_buffer_flag[session_id] = 1;
										/* do */
										store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );
									}
								}
							}
							else
							{
								if( server_buf[session_id]->end + spkt.len - 8 > server_buf[session_id]->alloc )
								{
									copy_server_buffer_size[session_id] = server_buf[session_id]->alloc - server_buf[session_id]->end;
									ssp[session_id] = 8 + server_buf[session_id]->alloc - server_buf[session_id]->end;

									memcpy( server_buf[session_id]->buf + server_buf[session_id]->end, &spkt.data[8],
											server_buf[session_id]->alloc - server_buf[session_id]->end );
									server_buf[session_id]->end = server_buf[session_id]->alloc;

									new_server_buffer_flag[session_id] = 1;
									/* do */
									store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );

									u_int buflen;

									while( copy_server_buffer_size[session_id] < spkt.len - 8 )
									{
										memcpy( &buflen, &spkt.data[ssp[session_id]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_server_type[session_id], &spkt.data[ssp[session_id] + 4], 1 );
										memcpy( &transfer_server_id[session_id], &spkt.data[ssp[session_id] + 5], 4 );
										transfer_server_id[session_id] = ntohl( transfer_server_id[session_id] );

										server_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
										server_buf[session_id]->buf    = ( u_char * )malloc( buflen );
										server_buf[session_id]->alloc  = buflen;
										server_buf[session_id]->offset = 0;
										server_buf[session_id]->end    = 0;

										/* Only a part of a new buffer */
										if( copy_server_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
										{
											int copy_size = spkt.len - 8 - copy_server_buffer_size[session_id] - 4;
											memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], copy_size );
											server_buf[session_id]->end += copy_size;

											copy_server_buffer_size[session_id] += ( copy_size + 4 );

											new_server_buffer_flag[session_id] = 0;
										}
										else
										{
											memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], buflen );
											server_buf[session_id]->end += buflen;

											copy_server_buffer_size[session_id] += ( buflen + 4 );
											ssp[session_id] += ( buflen + 4 );

											new_server_buffer_flag[session_id] = 1;
											/* do */
											store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );
										}
									}

								}
								else if( server_buf[session_id]->end + spkt.len - 8 == server_buf[session_id]->alloc )
								{
									memcpy( server_buf[session_id]->buf + server_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
									server_buf[session_id]->end += spkt.len - 8;

									new_server_buffer_flag[session_id] = 1;
									/* do */
									store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );
								}
								/* server_buf->end + spkt.len - 8 < server_buf->alloc */
								else
								{
									memcpy( server_buf[session_id]->buf + server_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
									server_buf[session_id]->end += spkt.len - 8;
								}
							}
						}
					}
				}
			}
			/* Log SSH1 data
			 * TODO: No need to log data that won't appear here */
			else
			{
				session_id = 0;

				if( show_stream )
				{
					printf( "SSH1 server@%d type=%d len=%d: ", getpid(), spkt.type, spkt.len );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( " %02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );
				}

				if( spkt.type == SSH_SMSG_EXITSTATUS )
				{
					if( session_channel_mode[0] == SSH_MODE )
					{
						session_channel_mode[0] = 0;
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
								"SSH1:Exit!\n",
								str_time( time( NULL ), NULL ), cstr, sstr );
						logit( "\n%s", buf );
						/* kill perl ssh1 */
					}

					if( session_channel_mode[0] == SFTP_MODE )
					{
						session_channel_mode[0] = 0;

						if( sql_conn )
						{
							snprintf( buf, sizeof( buf ),
									"UPDATE sftpsessions SET end=now() WHERE sid=%d",
									last_insert_id[0] );

							/* Insert success */
							if( !mysql_query( sql_conn, buf ) )
							{
								printf( "Mysql insert \"update\" command log success!\n" );
								last_insert_id[0] = 0;
							}
							else
							{
								if( mysql_errno( sql_conn ) )
								{
									printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
								}
							}
						}
					}
				}
				else if(( spkt.type == SSH_CMSG_STDIN_DATA ) ||
						( spkt.type == SSH_SMSG_STDOUT_DATA ) ||
						( spkt.type == SSH_SMSG_STDERR_DATA ) )
				{
					//                    if ((dst_data > 0) && (spkt.len >= 4))
					//                        writen(dst_data, &spkt.data[4], spkt.len-4);

					if( session_channel_mode[0] == SSH_MODE )
					{
						/* write to perl ssh1 server */
						if( !original_mode_flag )
						{
							telnet_writelogfile( &spkt.data[4], spkt.len - 4, monitor_shell_pipe_name[session_id],
									fd1[session_id], fd2[session_id], fd3[session_id], inputcommandline[session_id],
									commandline[session_id], &waitforline[session_id] );
						}

					}

					if( session_channel_mode[0] == SFTP_MODE )
					{
						if( server_first_init_flag[0] )
						{
							server_first_init_flag[0] = 0;
						}
						else
						{
							/* if buffer is larger than spkt.size */
							if( new_server_buffer_flag[0] )
							{
								u_int buflen;
								copy_server_buffer_size[0] = 0;
								ssp[0] = 4;

								while( copy_server_buffer_size[0] < spkt.len - 4 )
								{
									memcpy( &buflen, &spkt.data[ssp[0]], 4 );
									buflen = ntohl( buflen );
									memcpy( &command_server_type[0], &spkt.data[ssp[0] + 4], 1 );
									memcpy( &transfer_server_id[0], &spkt.data[ssp[0] + 5], 4 );
									transfer_server_id[0] = ntohl( transfer_server_id[0] );

									server_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
									server_buf[0]->buf    = ( u_char * )malloc( buflen );
									server_buf[0]->alloc  = buflen;
									server_buf[0]->offset = 0;
									server_buf[0]->end    = 0;

									/* Only a part of a new buffer */
									if( copy_server_buffer_size[0] + buflen + 4 > spkt.len - 4 )
									{
										int copy_size = spkt.len - 4 - copy_server_buffer_size[0] - 4;
										memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], copy_size );
										server_buf[0]->end += copy_size;

										copy_server_buffer_size[0] += ( copy_size + 4 );

										new_server_buffer_flag[0] = 0;
									}
									else
									{
										memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], buflen );
										server_buf[0]->end += buflen;

										copy_server_buffer_size[0] += ( buflen + 4 );
										ssp[0] += ( buflen + 4 );

										new_server_buffer_flag[0] = 1;
										/* do */
										store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );
									}
								}
							}
							else
							{
								if( server_buf[0]->end + spkt.len - 4 > server_buf[0]->alloc )
								{
									copy_server_buffer_size[0] = server_buf[0]->alloc - server_buf[0]->end;
									ssp[0] = 4 + server_buf[0]->alloc - server_buf[0]->end;

									memcpy( server_buf[0]->buf + server_buf[0]->end, &spkt.data[4],
											server_buf[0]->alloc - server_buf[0]->end );
									server_buf[0]->end = server_buf[0]->alloc;

									new_server_buffer_flag[0] = 1;
									/* do */
									store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );

									u_int buflen;

									while( copy_server_buffer_size[0] < spkt.len - 4 )
									{
										memcpy( &buflen, &spkt.data[ssp[0]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_server_type[0], &spkt.data[ssp[0] + 4], 1 );
										memcpy( &transfer_server_id[0], &spkt.data[ssp[0] + 5], 4 );
										transfer_server_id[0] = ntohl( transfer_server_id[0] );

										server_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
										server_buf[0]->buf    = ( u_char * )malloc( buflen );
										server_buf[0]->alloc  = buflen;
										server_buf[0]->offset = 0;
										server_buf[0]->end    = 0;

										/* Only a part of a new buffer */
										if( copy_server_buffer_size[0] + buflen + 4 > spkt.len - 4 )
										{
											int copy_size = spkt.len - 4 - copy_server_buffer_size[0] - 4;
											memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], copy_size );
											server_buf[0]->end += copy_size;

											copy_server_buffer_size[0] += ( copy_size + 4 );

											new_server_buffer_flag[0] = 0;
										}
										else
										{
											memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], buflen );
											server_buf[0]->end += buflen;

											copy_server_buffer_size[0] += ( buflen + 4 );
											ssp[0] += ( buflen + 4 );

											new_server_buffer_flag[0] = 1;
											/* do */
											store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );
										}
									}

								}
								else if( server_buf[0]->end + spkt.len - 4 == server_buf[0]->alloc )
								{
									memcpy( server_buf[0]->buf + server_buf[0]->end, &spkt.data[4], spkt.len - 4 );
									server_buf[0]->end += spkt.len - 4;

									new_server_buffer_flag[0] = 1;
									/* do */
									store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );
								}
								/* server_buf->end + spkt.len - 8 < server_buf->alloc */
								else
								{
									memcpy( server_buf[0]->buf + server_buf[0]->end, &spkt.data[4], spkt.len - 4 );
									server_buf[0]->end += spkt.len - 4;
								}
							}
						}
					}
				}
				else if( spkt.type == SSH_CMSG_USER )
				{
					snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
							"\nSSH_CMSG_USER: %s", str_time( time( NULL ), NULL ),
							sstr, cstr, &spkt.data[4] );
					logit( "%s", buf );

					if( logf )
					{
						fprintf( logf, "%s\n\n", buf );
						fflush( logf );
					}
				}
				else if( spkt.type == SSH_CMSG_AUTH_PASSWORD )
				{
					snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
							"\nSSH_CMSG_AUTH_PASSWORD: %s", str_time( time( NULL ), NULL ),
							sstr, cstr, &spkt.data[4] );
					logit( "%s", buf );

					if( logf )
					{
						fprintf( logf, "%s\n\n", buf );
						fflush( logf );
					}
				}
			}

			if( forward2client_flag == 1 )
			{
				forward2client_flag = 0;
				packet_start( forward2client_packet.type );
				packet_put_raw( forward2client_packet.data, forward2client_packet.len );
				packet_send();
				packet_write_wait();
			}

			memset( &spkt, 0x00, spkt.len + 8 );
		}

		while( queue_size() > 0 )
		{
			int index = queue_top();
			u_int ctype, stype, sid;
			Buffer * cbuf, * sbuf;

			sid   = transfer_queue[index].session_id;
			ctype = transfer_queue[index].client_command_type;
			stype = transfer_queue[index].server_command_type;
			cbuf  = transfer_queue[index].client_queue_buf;
			sbuf  = transfer_queue[index].server_queue_buf;

			if( no_daemon_flag )
			{
				printf( "SID:%d\t\tID:%d\t\t", transfer_queue[index].session_id, transfer_queue[index].transfer_id );
				printf( "ctype %d\t\t",     transfer_queue[index].client_command_type );
				printf( "stype %d\n",     transfer_queue[index].server_command_type );

				if( show_stream )
				{
					for( i = 0; i < buffer_len( cbuf ); i++ )
					{
						if( isprint( *( cbuf->buf + i ) ) ) printf( "%c", *( cbuf->buf + i ) );
						else printf( "%02x ", ( unsigned char )*( cbuf->buf + i ) );
					}

					printf( "\n" );

					for( i = 0; i < buffer_len( sbuf ); i++ )
					{
						if( isprint( *( sbuf->buf + i ) ) ) printf( "%c", *( sbuf->buf + i ) );
						else printf( "%02x ", ( unsigned char )*( sbuf->buf + i ) );
					}

					printf( "\n\n" );
				}
			}

			/* Download or upload file */
			if( ctype == SSH2_FXP_OPEN && stype == SSH2_FXP_HANDLE )
			{
				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				/* Get filename */
				filename_tmp = buffer_get_string( cbuf, &filename_len );
				filename = g2u( filename_tmp );
				filename_len = strlen( filename );

				/* Get flag */
				wr_flag = buffer_get_int( cbuf );
				int tmp_wr_flag = wr_flag;
				tmp_wr_flag &= ~0xfffffffd;

				//printf("wr_flag = %d\n",wr_flag);

				if( tmp_wr_flag )
				{
					log_upload_file_flag[sid] = 1;

					/* Get pflag for sftp put command */
					upload_pflag[sid] = buffer_get_int( cbuf );

					/* No pflag */
					if( upload_pflag[sid] == 0x00000004 )
					{
						upload_pflag[sid] = 0;
					}
					/* Have pflag */
					else if( upload_pflag[sid] == 0x0000000c )
					{
						upload_pflag[sid] = 1;
					}
					/* Unknow */
					else upload_pflag[sid] = 2;

					/* Creat backup fd of upload file */
					/*snprintf(buf, sizeof(buf), "%s/backup_put_file/%s %s -> %s [%s]", options.c_logdir,
					  modify_filename(filename,filename_len), cstr, sstr, str_time(time(NULL), NULL) );*/
					snprintf( buf, sizeof( buf ), "/opt/freesvr/audit/log/sftp/upload/%s[%s]",
							modify_filename( filename, filename_len ), str_time( time( NULL ), NULL ) );
					//memset ( backup_upload_fn[sid], 0x00, sizeof(backup_upload_fn[sid]) );
					strcpy( backup_upload_fn[sid], buf );

					if(( backup_upload_file[sid] = open( buf, O_RDWR | O_APPEND | O_CREAT, 0777 ) ) < 0 )
						error( "Failed to open log_download_file_data: '%s'", buf );
				}
				else if( wr_flag == 0x00000001 )
				{
					log_download_file_flag[sid] = 1;

					/* Creat backup fd of download file */
					/*snprintf(buf, sizeof(buf), "%s/backup_get_file/%s %s <- %s [%s]", options.c_logdir,
					  modify_filename(filename,filename_len), cstr, sstr, str_time(time(NULL), NULL) );*/
					snprintf( buf, sizeof( buf ), "/opt/freesvr/audit/log/sftp/download/%s[%s]",
							modify_filename( filename, filename_len ), str_time( time( NULL ), NULL ) );
					//printf("%s\n",buf);
					strcpy( backup_download_fn[sid], buf );

					if(( log_download_file_data[sid] = open( buf, O_RDWR | O_APPEND | O_CREAT, 0777 ) ) < 0 )
						error( "Failed to open log_download_file_data: '%s'", buf );
				}
			}

			if( ctype == SSH2_FXP_READ && stype == SSH2_FXP_DATA
					&& log_download_file_flag[sid] && log_download_file_data[sid] > 0 )
			{
				/* Skip server type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				data = buffer_get_string( sbuf, &datalen );

				/* Skip client type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				/* Skip handle */
				buffer_get_string( cbuf, NULL );

				/* Get offset of file */
				offset = buffer_get_int64( cbuf );

				if( lseek( log_download_file_data[sid], offset, SEEK_SET ) != -1 )
					write( log_download_file_data[sid], data, datalen );
			}

			if(( ctype == SSH2_FXP_READ || ctype == SSH2_FXP_CLOSE ) && stype == SSH2_FXP_STATUS && log_download_file_flag[sid] )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				//printf( "server_status = %d\n", server_status );
				struct stat stmp;
				stat( backup_download_fn[sid], &stmp );

				if( stmp.st_size > sftp_backup_size * 1000000 )
				{
					remove( backup_download_fn[sid] );
					strcpy( backup_download_fn[sid], "" );
				}

				/* Download success, close fd and modify the flag */
				if( server_status == SSH2_FX_EOF || server_status == SSH2_FX_OK )
				{
					log_download_file_flag[sid] = 0;
					close( log_download_file_data[sid] );

					bzero(buf, sizeof(buf));
					snprintf( buf, sizeof( buf ), "[%s] get %s %s <- %s\n",
							str_time( time( NULL ), NULL ), filename, cstr, sstr );
					write( sftp_log, buf, strlen( buf ) );


					if( sql_conn )
					{
						snprintf( buf, sizeof( buf ),
								"INSERT INTO sftpcomm(sid,comm,at,filename) VALUES(%d,'%s %s',now(),'%s')",
								last_insert_id[sid], "get", filename, backup_download_fn[sid] );

						/* Insert success */
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "SID = %d, Mysql insert \"get\" command log success!\n", sid );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
					}
				}
				else
				{
					//error
				}
			}

			if( ctype == SSH2_FXP_WRITE && stype == SSH2_FXP_STATUS
					&& log_upload_file_flag[sid] && backup_upload_file[sid] > 0 )
			{
				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				/* Skip handle and offset */
				buffer_get_string( cbuf, NULL );
				offset = buffer_get_int64( cbuf );

				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Write success, log it */
				if( server_status == SSH2_FX_OK )
				{
					data = buffer_get_string( cbuf, &datalen );

					if( lseek( backup_upload_file[sid], offset, SEEK_SET ) != -1 )
						write( backup_upload_file[sid], data, datalen );
				}
				else
				{
					log_upload_file_flag[sid] = 0;
					close( backup_upload_file[sid] );
				}
			}

			if( ctype == SSH2_FXP_CLOSE && stype == SSH2_FXP_STATUS && log_upload_file_flag[sid] )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				struct stat stmp;
				stat( backup_upload_fn[sid], &stmp );

				if( stmp.st_size > sftp_backup_size * 1000000 )
				{
					remove( backup_upload_fn[sid] );
					strcpy( backup_upload_fn[sid], "" );
				}

				/* upload success, close fd and modify the flag */
				if( server_status == SSH2_FX_OK )
				{
					log_upload_file_flag[sid] = 0;
					close( backup_upload_file[sid] );

					bzero(buf, sizeof(buf));
					snprintf( buf, sizeof( buf ), "[%s] put%s %s %s -> %s\n",
							str_time( time( NULL ), NULL ), ( upload_pflag == 1 ) ? " -p" : "", filename, cstr, sstr );
					write( sftp_log, buf, strlen( buf ) );

					if( sql_conn )
					{
						snprintf( buf, sizeof( buf ),
								"INSERT INTO sftpcomm(sid,comm,at,filename) VALUES(%d,'%s%s %s',now(),'%s')",
								last_insert_id[sid], "put", ( upload_pflag == 1 ) ? " -p" : "", filename, backup_upload_fn[sid] );

						/* Insert success */
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "SID = %d, Mysql insert \"put\" command log success!\n", sid );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
					}
				}
				else
				{
					//error
				}
			}

			/* Process mkdir command */
			if( ctype == SSH2_FXP_MKDIR && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *dirpath = buffer_get_string( cbuf, NULL );
				//printf( "g2u: %s\n", g2u( dirpath ) );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "mkdir", g2u( dirpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"mkdir\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
				}
			}

			/* Process rmdir command */
			if( ctype == SSH2_FXP_RMDIR && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *dirpath = buffer_get_string( cbuf, NULL );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "rmdir", g2u( dirpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"rmdir\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
				}
			}

			/* Process SYMLINK command */
			if( ctype == SSH2_FXP_SYMLINK && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *oldpath = buffer_get_string( cbuf, NULL );
				char *newpath = buffer_get_string( cbuf, NULL );

				bzero( oldt, sizeof(oldt) );
				bzero( newt, sizeof(newt) );
				strcpy( oldt, g2u(oldpath) );
				strcpy( newt, g2u(newpath) );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s %s',now(),%d)",
							last_insert_id[sid], "ln", oldt, newt, ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"ln\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
				}
			}

			/* Process rm command */
			if( ctype == SSH2_FXP_REMOVE && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *rmpath = buffer_get_string( cbuf, NULL );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "rm", g2u( rmpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"rm\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
				}
			}

			/* Process chmod command */
			if( ctype == SSH2_FXP_SETSTAT && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *chpath = buffer_get_string( cbuf, NULL );
				Attrib *attr = decode_attrib( cbuf );

				if( attr->flags & SSH2_FILEXFER_ATTR_PERMISSIONS )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %o %s',now(),%d)",
							last_insert_id[sid], "chmod", attr->perm & 07777, g2u( chpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					if( sql_conn )
					{
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "Mysql insert \"chmod\" command log success!\n" );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
					}
				}

				if( attr->flags & SSH2_FILEXFER_ATTR_UIDGID )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %d:%d %s',now(),%d)",
							last_insert_id[sid], "chown", attr->uid, attr->gid, g2u( chpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					if( sql_conn )
					{
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "Mysql insert \"chown\" command log success!\n" );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
					}
				}
			}

			/* Process cd command */
			if( ctype == SSH2_FXP_REALPATH )
			{
				char *cdpath;
				int cdret;

				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				if( stype == SSH2_FXP_NAME )
				{
					buffer_get_int( sbuf );
					cdpath = buffer_get_string( sbuf, NULL );
					cdret = 1;
				}
				else
				{
					buffer_get_char( cbuf );
					buffer_get_int( cbuf );
					cdpath = buffer_get_string( cbuf, NULL );
					cdret = 0;
				}

				if( sql_conn && 0 )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "cd", g2u( cdpath ), ( cdret ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"cd\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
				}
			}

			/* Process rename command */
			if(( ctype == SSH2_FXP_RENAME || ctype == SSH2_FXP_EXTENDED ) && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				if( server_status == SSH2_FX_OK )
				{
					/* Skip type and id */
					buffer_get_char( cbuf );
					buffer_get_int( cbuf );

					/* Skip "posix-rename@openssh.com" */
					if( ctype == SSH2_FXP_EXTENDED )
					{
						buffer_get_string( cbuf, NULL );
					}

					char * oldpath = buffer_get_string( cbuf, NULL );
					char * newpath = buffer_get_string( cbuf, NULL );

					bzero( oldt, sizeof(oldt) );
					bzero( newt, sizeof(newt) );
					strcpy( oldt, g2u(oldpath) );
					strcpy( newt, g2u(newpath) );

					//printf( "old:%s  new:%s\n", oldpath, newpath );
					//printf( "old:%s  new:%s\n", oldt, newt );
					//printf( "old:%s  new:%s\n", oldpath, newpath );

					bzero(buf, sizeof(buf));
					snprintf( buf, sizeof( buf ), "[%s] rename %s %s %s <- %s\n",
							str_time( time( NULL ), NULL ), oldt, newt, cstr, sstr );
					write( sftp_log, buf, strlen( buf ) );

					if( sql_conn )
					{
						snprintf( buf, sizeof( buf ),
								"INSERT INTO sftpcomm(sid,comm,at) VALUES(%d,'%s %s %s',now())",
								last_insert_id[sid], "rename", oldt, newt );

						/* Insert success */
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "Mysql insert \"rename\" command log success!\n" );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
					}
				}
			}

			queue_pop();
		}
	}//end for(;;)

	/* If the spoofed client decided to shut down the connection, this is
	 * a great place for hijacking :-) */
	if( errno && n )
		logit( "** Error: %s\n", strerror( errno ) );

	packet_close();
	kill( SIGTERM, pid );
	wait( NULL );

	if( src_data > 0 )
		close( src_data );

	if( dst_data > 0 )
		close( dst_data );

	if( sftp_log > 0 )
		close( sftp_log );

	if( logf )
		fclose( logf );

	if( log_download_file_data > 0 )
		close( log_download_file_data );

	if( backup_upload_file > 0 )
		close( backup_upload_file );

	exit( errno ? EXIT_FAILURE : EXIT_SUCCESS );
}

struct simple_packet data_cpy[64];
int data_cnt = 0;
struct simple_packet aareq_cpy[64];
int aareq_cnt = 0;

uid_t original_real_uid;
uid_t original_effective_uid;
pid_t proxy_command_pid;
Options client_options;

extern int supported_authentications;

int target_auth( int sock, int sp, int * client_session_id_arg )
{
	printf( "target_auth!\n" );
	char * pt;
	int i, ret = 1, index, remote_id, size, num_prompts, uret;
	int userauth_failure_cnt = 0, challenge_failure_cnt = 0, is_challenge = 1, passwd_len;
	struct simple_packet spkt;
	struct timeval timeout;
	char * padded, target_password[32], status;
	int client_session_id=0, server_session_id = 0;
	/* Creat SSH2 Request and Password string */
	if( compat20 )
	{
		packet_start( SSH2_MSG_SERVICE_REQUEST );
		packet_put_cstring( "ssh-userauth" );
		packet_send();
		packet_write_wait();
	}
	/* Creat SSH1 Request and Password string */
	else
	{
		packet_start( SSH_CMSG_USER );
		packet_put_cstring( conn2server_username );
		packet_send();
		packet_write_wait();
	}

	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( sock, &readset );
	FD_SET( sp,   &readset );
	memset( &spkt, 0x00, sizeof( spkt ) );

	while( ret )
	{
		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );

		if( select(( sock > sp ? sock : sp ) + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( sock, &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading from client on client side" );

			while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
			{
				pt = packet_get_raw( &spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				memcpy( spkt.data, pt, spkt.len );
				debug( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );

				if( show_stream )
				{
					printf( "[target auth@%d] from server. type=%d  %d: ", getpid(), spkt.type, spkt.len );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else
							printf( " %02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );
				}

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_SERVICE_ACCEPT && !publickey_auth )
					{
						packet_start( SSH2_MSG_USERAUTH_REQUEST );
						packet_put_cstring( conn2server_username );
						packet_put_cstring( "ssh-connection" );
						packet_put_cstring( "none" );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_SERVICE_ACCEPT && publickey_auth )
					{
						chmod ( privatekey_path, 0600 );
						uret = userauth_pubkey_client(conn2server_username, privatekey_path,"");
						printf( "userauth_pubkey_client ret = %d\n", uret );
						if ( uret == 10 )
						{
							status = 0x02;
							writen( sp, &status, 1 );
							printf( "Private key need passphrase.\n" );
						}
						else if ( uret == -1 )
						{
							status = 0x01;
							write( sp, &status, 1 );
							usleep(200000);
							fatal( "Can't find private key \"%s\".", privatekey_path );
						}
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_SUCCESS && publickey_auth )
					{
						status = 0x01;
						writen( sp, &status, 1 );
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_FAILURE && publickey_auth )
					{
						status = 0x01;
						write( sp, &status, 1 );
						usleep(200000);
						fatal( "Server can not match this private key. ERROR.\n" );

						//ret = 0;
						//return 0;
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_FAILURE )
					{
						userauth_failure_cnt++;

						if( userauth_failure_cnt == 1 )
						{
							char *method = packet_get_string(NULL);
							
							if( strstr( method,"keyboard-interactive" ) == NULL )
							{
								packet_start( SSH2_MSG_USERAUTH_REQUEST );
							packet_put_cstring( conn2server_username );
							packet_put_cstring( "ssh-connection" );
							packet_put_cstring( "password" );
							packet_put_char( 0 );
							packet_put_cstring( conn2server_password );
							packet_send();
							packet_write_wait();
							}
							else
							{
							packet_start( SSH2_MSG_USERAUTH_REQUEST );
							packet_put_cstring( conn2server_username );
							packet_put_cstring( "ssh-connection" );
							packet_put_cstring( "keyboard-interactive" );
							packet_put_cstring( "" );
							packet_put_cstring( "" );
							packet_send();
							packet_write_wait();
							}

							xfree( method );
						}
						else if( is_challenge == 1 && userauth_failure_cnt == 2 )
						{
							packet_start( SSH2_MSG_USERAUTH_REQUEST );
							packet_put_cstring( conn2server_username );
							packet_put_cstring( "ssh-connection" );
							packet_put_cstring( "password" );
							packet_put_char( 0 );
							packet_put_cstring( conn2server_password );
							packet_send();
							packet_write_wait();
						}
						else
						{
							//char tmpbuf[] = "password error!";
							//printf("size: %d\n", sizeof(tmpbuf) );
							status = 0x02;
							writen( sp, &status, 1 );
							printf( "PASSWORD ERROR\n" );
						}
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_INFO_REQUEST )
					{
						is_challenge = 1024;
						packet_get_string( NULL );
						packet_get_string( NULL );
						packet_get_string( NULL );
						num_prompts = packet_get_int();

						if( num_prompts > 1 )
						{
							/* debug */
						}

						packet_start( SSH2_MSG_USERAUTH_INFO_RESPONSE );
						packet_put_int( num_prompts );

						for( i = 0; i < num_prompts; i++ )
						{
							packet_get_string( NULL );
							packet_get_char();
							packet_put_cstring( conn2server_password );
						}

						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_SUCCESS && !publickey_auth )
					{
						//ret = 0;
						status = 0x01;
						writen( sp, &status, 1 );
					}
				}

				else
				{
					if( is_challenge && spkt.type == SSH_SMSG_FAILURE )
					{
						is_challenge --;
						challenge_failure_cnt++;

						/*if ((supported_authentications & (1 << SSH_AUTH_TIS)) &&
						  client_options.challenge_response_authentication &&
						  !client_options.batch_mode)*/
						if( challenge_failure_cnt == 1 )
						{
							packet_start( SSH_CMSG_AUTH_TIS );
							packet_send();
							packet_write_wait();
						}
						else
						{
							status = 0x0;
							writen( sp, &status, 1 );
							printf( "Password error!\n" );
						}

						/*if ((supported_authentications & (1 << SSH_AUTH_PASSWORD)) &&
						  client_options.password_authentication &&
						  !client_options.batch_mode)
						  {
						  packet_start(SSH_CMSG_AUTH_PASSWORD);
						  packet_put_cstring(conn2server_password);
						  packet_send();
						  packet_write_wait();
						  }*/
					}
					else if( !is_challenge && spkt.type == SSH_SMSG_FAILURE )
					{
						/* Password auth */
						userauth_failure_cnt++;

						if( userauth_failure_cnt == 1 )
						{
							packet_start( SSH_CMSG_AUTH_PASSWORD );
							packet_put_cstring( conn2server_password );
							packet_send();
							packet_write_wait();
						}
						else
						{
							status = 0x02;
							writen( sp, &status, 1 );
							printf( "Password error!\n" );
						}
					}
					else if( spkt.type == SSH_SMSG_SUCCESS )
					{
						status = 0x01;
						writen( sp, &status, 1 );
					}
					else if( spkt.type == SSH_SMSG_AUTH_TIS_CHALLENGE )
					{
						is_challenge = 1024;
						packet_start( SSH_CMSG_AUTH_TIS_RESPONSE );
						size = roundup( strlen( conn2server_password ) + 1, 32 );
						padded = xcalloc( 1, size );
						strlcpy( padded, conn2server_password, size );
						packet_put_string( padded, size );
						printf( "size = %d\n", size );
						memset( padded, 0, size );
						xfree( padded );
						packet_send();
						packet_write_wait();
					}
				}

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}

		if( FD_ISSET( sp, &readtmp ) )
		{
			bzero( target_password, sizeof( target_password ) );
			//printf("recv\n");
			readn( sp, target_password, 4 );
			//printf("recv\n");
			passwd_len = get_u32( target_password );

			if( passwd_len == 1024 )
			{
				ret = 0;
			}
			else
			{
				readn( sp, target_password + 4, passwd_len );
				//printf("%d %s\n", passwd_len, target_password+4);

				if( compat20 )
				{
					if ( publickey_auth )
					{
						uret =  userauth_pubkey_client(conn2server_username, privatekey_path,target_password + 4);
						printf( "userauth_pubkey_client ret = %d\n", uret );
						if ( uret != 1 ) fatal("userauth_pubkey_client failed");
					}
					else if( is_challenge == 1 )
					{
						packet_start( SSH2_MSG_USERAUTH_REQUEST );
						packet_put_cstring( conn2server_username );
						packet_put_cstring( "ssh-connection" );
						packet_put_cstring( "password" );
						packet_put_char( 0 );
						packet_put_cstring( target_password + 4 );
						packet_send();
						packet_write_wait();
					}
					else
					{
						strcpy( conn2server_password, target_password + 4 );
						packet_start( SSH2_MSG_USERAUTH_REQUEST );
						packet_put_cstring( conn2server_username );
						packet_put_cstring( "ssh-connection" );
						packet_put_cstring( "keyboard-interactive" );
						packet_put_cstring( "" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
					}
				}
				else//ssh1
				{
					if( is_challenge > 0 )
					{
						/*packet_start(SSH_CMSG_AUTH_TIS_RESPONSE);
						  size = roundup(strlen(target_password+4) + 1, 32);
						  padded = xcalloc(1, size);
						  strlcpy(padded, target_password+4, size);
						  packet_put_string(padded, size);
						  printf("size = %d\n", size);
						  memset(padded, 0, size);
						  xfree(padded);
						  packet_send();
						  packet_write_wait();*/
						strcpy( conn2server_password, target_password + 4 );
						packet_start( SSH_CMSG_AUTH_TIS );
						packet_send();
						packet_write_wait();
					}
					else
					{
						packet_start( SSH_CMSG_AUTH_PASSWORD );
						packet_put_cstring( target_password + 4 );
						packet_send();
						packet_write_wait();
					}
				}
			}
		}
	}

	if( compat20 )
	{
		for( index = 0; index < mitm_channel_cnt; index++ )
		{
			int j;
			printf( "lianjie : spkt.type = %d, spkt.len = %d\n", mitm_channel_request[index].type, mitm_channel_request[index].len );
			
			/* add for H3C */
			u_int32_t proxy2client_sessionid;

			proxy2client_sessionid = get_u32(&(mitm_channel_request[index].data[0]));
			u_char replace_buf[4];
			if( mitm_channel_request[index].type >= 91 && mitm_channel_request[index].type <= 100 && proxy2client_sessionid == proxy_server_session_id )
			{
				//put_u32( replace_buf, session_map[proxy2client_sessionid] );
				put_u32( replace_buf, session_map[client_session_id] );
				printf( "Audit tell client server session id is %d, but the real server sid is %d\n", proxy2client_sessionid, session_map[client_session_id] );
				for( j = 0; j < 4; j++ )
				{
					mitm_channel_request[index].data[j] = replace_buf[j];
				}
			}


			for( j = 0; j < mitm_channel_request[index].len; j++ )
			{
				if( isprint( mitm_channel_request[index].data[j] ) ) printf( "%c", mitm_channel_request[index].data[j] );
				else printf( "%02x ", ( u_char )mitm_channel_request[index].data[j] );
			}

			printf( "\n" );
			
			/* add for H3C */
			/*u_int32_t proxy2client_sessionid;

			proxy2client_sessionid = get_u32(&(mitm_channel_request[index].data[0]));
			u_char replace_buf[4];
			if( mitm_channel_request[index].type >= 91 && mitm_channel_request[index].type <= 100 && proxy2client_sessionid == proxy_server_session_id )
			{
				put_u32( replace_buf, session_map[proxy2client_sessionid] );
				for( j = 0; j < 4; j++ )
				{
					mitm_channel_request[index].data[4+j] = replace_buf[j];
				}
			}*/

			packet_start( mitm_channel_request[index].type );
			packet_put_raw( mitm_channel_request[index].data, mitm_channel_request[index].len );
			packet_send();
			packet_write_wait();
			ret = mitm_channel_reply[index];
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( ret )
			{
				if( select( sock + 1, &readset, NULL, NULL, NULL ) < 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
						printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

						/*for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}*/
						unsigned char *p1=&spkt;
						for( i = 0; i < spkt.len+8; i++ )
						{
							if( isprint( *(p1+i) ) ) printf( "%c", *(p1+i) );
							else printf( " %02x ", *(p1+i) );
						}

						printf( "\n" );

						if( spkt.type == 94 )
						{
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
						}
						else if( spkt.type == 91 )
						{
							client_session_id = packet_get_int();
							server_session_id = packet_get_int();
							printf( "client_session_id=%d, server_session_id=%d\n", client_session_id, server_session_id );
							session_map[client_session_id] = server_session_id;
							if( client_session_id_arg != NULL ) *client_session_id_arg = client_session_id;
							ret = 0;
						}
						else if( spkt.type == 99 || spkt.type == 93 )
						{
							remote_id = packet_get_int();

							//printf( "remote_id = %d\n", remote_id );
							if( no_shell || ( remote_id != 0 && remote_id != 256 ) )
							{
								/* to fix when will appear type 93 data */
								if( no_shell && spkt.type == 99 && aareq_cnt == 0 )
								{
									unsigned char tmp93[16] = {0x5d,0x00,0x00,0x00,0x08,0x00,0x00,0x00,0x00,0x00,0x01,0x00,0x00,0x20,0x00,0x00 };
									printf ("client session id = %d, session_map = %d\n", client_session_id, session_map[client_session_id]);
									//put_u32( &tmp93[8], session_map[client_session_id] );
									put_u32( &tmp93[8], client_session_id );
									memcpy( &aareq_cpy[aareq_cnt++], tmp93, 16 );
								}
								/* for freesshd*/
								/*else if (remote_id == 256)
								{
									unsigned char tmp93[16] = {0x5d,0x00,0x00,0x00,0x08,0x00,0x00,0x00,0x00,0x00,0x01,0x00,0x00,0x20,0x00,0x00 };
									put_u32( &tmp93[8], session_map[client_session_id] );
									memcpy( &aareq_cpy[aareq_cnt++], tmp93, 16 );
								}
								else*/
									memcpy( &aareq_cpy[aareq_cnt++], &spkt, spkt.len + 8 );
							}

							ret = 0;
						}
						else
						{
							ret = 0;
						}

						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}

				printf( "ret = %d\n", ret );
			}
		}

		memset( &spkt, 0x00, sizeof( spkt ) );
		FD_ZERO( &readset );
		FD_SET( sock, &readset );

		while( conn_mode != CONN_PROXY_REPLAY && 1 )
		{
			timeout.tv_sec = 0;
			timeout.tv_usec = 3000 * 1000;

			if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
			{
				if( errno == EINTR )
					continue;

				break;
			}

			if( FD_ISSET( sock, &readset ) )
			{
				while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
				{
					pt = packet_get_raw( &spkt.len );

					/* Do not send along packets that only affect us */
					if( process_packet( spkt.type, spkt.data ) != 0 )
					{
						memset( &spkt, 0x00, spkt.len + 8 );
						continue;
					}

					if( spkt.len > sizeof( spkt.data ) )
					{
						fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
								spkt.len, sizeof( spkt.data ) );
					}

					memcpy( spkt.data, pt, spkt.len );
					debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
					printf( "lianjie wait for welcome message: copy %d:: type = %d with time out.", index, spkt.type );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( "%02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );

					if( conn_mode != CONN_PROXY_REPLAY && spkt.type == 94 )
					{
						memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
					}
					else if( spkt.type == 99 || spkt.type == 93 )
					{
						remote_id = packet_get_int();

						//printf( "remote_id = %d\n", remote_id );
						if( no_shell || ( remote_id != 0 && remote_id != 256 ) )
						{
							memcpy( &aareq_cpy[aareq_cnt++], &spkt, spkt.len + 8 );
						}

						ret = 0;
					}
					else
					{
						ret = 0;
					}

					memset( &spkt, 0x00, spkt.len + 8 );
				}
			}
		}

		if( auto_su && conn_mode < 5  && no_shell == 0 )
		{
			packet_start( 94 );
			packet_put_int( 0 );
			/*if ( !router )
			  packet_put_cstring("su -\x0d");
			  else
			  packet_put_cstring("enable\x0d");*/
			char command_buf[32];
			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_command );
			packet_put_cstring( command_buf );
			packet_send();
			packet_write_wait();
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( 1 )
			{
				timeout.tv_sec = 0;
				timeout.tv_usec = 200 * 1000;

				if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
						printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );

						if( spkt.type == 94 )
						{
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
						}
						else if( spkt.type == 99 || spkt.type == 93 )
						{
							remote_id = packet_get_int();

							//printf( "remote_id = %d\n", remote_id );
							if( no_shell || ( remote_id != 0 && remote_id != 256 ) )
							{
								memcpy( &aareq_cpy[aareq_cnt++], &spkt, spkt.len + 8 );
							}

							ret = 0;
						}
						else
						{
							ret = 0;
						}

						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}
			}

			packet_start( 94 );
			packet_put_int( 0 );
			//char command_buf[32];
			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_password );
			packet_put_cstring( command_buf );
			packet_send();
			packet_write_wait();
		}

	}
	else
	{

		for( index = 0; index < mitm_channel_cnt; index++ )
		{
			packet_start( mitm_channel_request[index].type );
			packet_put_raw( mitm_channel_request[index].data, mitm_channel_request[index].len );
			packet_send();
			packet_write_wait();
			ret = mitm_channel_reply[index];
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( ret )
			{
				if( select( sock + 1, &readset, NULL, NULL, NULL ) < 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );

						//                    printf ("lianjie: ");
						//                    for ( i = 0; i < spkt.len; i++ )
						//                    {
						//                        printf( "%02x ", (u_char)spkt.data[i] );
						//                    }
						//                    printf("\n");
						if( spkt.type == 17 )
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );

						ret = 0;
						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}
			}
		}

		memset( &spkt, 0x00, sizeof( spkt ) );
		FD_ZERO( &readset );
		FD_SET( sock, &readset );

		while( 1 )
		{
			timeout.tv_sec = 0;
			timeout.tv_usec = 200 * 1000;

			if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
			{
				if( errno == EINTR )
					continue;

				break;
			}

			if( FD_ISSET( sock, &readset ) )
			{
				while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
				{
					pt = packet_get_raw( &spkt.len );

					/* Do not send along packets that only affect us */
					if( process_packet( spkt.type, spkt.data ) != 0 )
					{
						memset( &spkt, 0x00, spkt.len + 8 );
						continue;
					}

					if( spkt.len > sizeof( spkt.data ) )
					{
						fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
								spkt.len, sizeof( spkt.data ) );
					}

					memcpy( spkt.data, pt, spkt.len );
					debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
					printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( "%02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );

					if( spkt.type == 17 )
					{
						memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
					}
					else
					{
						ret = 0;
					}

					memset( &spkt, 0x00, spkt.len + 8 );
				}
			}
		}

		if( auto_su && conn_mode < 5 && no_shell == 0 )
		{
			packet_start( SSH_CMSG_STDIN_DATA );

			char command_buf[32];
			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_command );
			packet_put_cstring( command_buf );

			packet_send();
			packet_write_wait();
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( 1 )
			{
				timeout.tv_sec = 0;
				timeout.tv_usec = 200 * 1000;

				if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
						printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );

						if( spkt.type == SSH_SMSG_STDOUT_DATA )
						{
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
						}

						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}
			}

			packet_start( SSH_CMSG_STDIN_DATA );

			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_password );
			packet_put_cstring( command_buf );

			packet_send();
			packet_write_wait();
		}
	}

	//printf("done!\n");
}


/*
 * Connect to the real target
 * IP and port in network byte order.
 */

	void
target_connect( u_int ip, u_short port, int sp, u_int ssh_proto )
{
	//compat20 = 0;
	//printf("port ===== %d\n", port);
	//publickey_auth = 1;
	//strcpy(privatekey_path,"/home/zhangzhong/id_rsa");
	struct sockaddr_storage hostaddr;
	struct sockaddr_in tin;
	struct simple_packet spkt;
	char target_host[48];
	int sock, i;
	int timeout_ms;
	fd_set readset;
	size_t nfd;
	ssize_t n;
	int client_session_id_arg;

	tin.sin_addr.s_addr = ip;
	snprintf( target_host, sizeof( target_host ), "%s", inet_ntoa( tin.sin_addr ) );

	
	setproctitle("[%s]Audit->[%s]", str_time(time(NULL), NULL), inet_ntoa( tin.sin_addr ) );

	debug2( "[FREESVR-SSH-PROXY] Connecting to real target (%s %s:%u)",
			ssh_proto == SSH_PROTO_2 ? "SSH2" : "SSH1",
			target_host, ntohs( port ) );

	init_rng();
	original_real_uid = getuid();
	original_effective_uid = geteuid();

	/* Init options */
	initialize_options( &client_options );
	client_options.protocol = ssh_proto;
	client_options.address_family = AF_INET;
	client_options.cipher = -1;

	/* Fill configuration defaults. */
	fill_default_options( &client_options );

	SSLeay_add_all_algorithms();
	ERR_load_crypto_strings();

	channel_set_af( client_options.address_family );
	seed_rng();

	timeout_ms = client_options.connection_timeout * 1000;

	if( ssh_connect( target_host, &hostaddr, htons( port ),
				client_options.address_family, client_options.connection_attempts,
				&timeout_ms, client_options.tcp_keep_alive,
				client_options.use_privileged_port, NULL ) != 0 )
		fatal( "** Error: SSH connection to real target failed\n" );

	//extern supported_authentications;
	//printf ( "supported_authentications = %d\n", supported_authentications);
	/* Exchange protocol version identification strings with the server. */
	ssh_exchange_identification();

	/* Put the connection into non-blocking mode. */
	packet_set_nonblocking();

	/* Exchange keys */
	if( compat20 )
		ssh_kex2( target_host, ( struct sockaddr * )&hostaddr );
	else
		ssh_kex( target_host, ( struct sockaddr * )&hostaddr );

	/* Get the connected socket */
	sock = packet_get_connection_in();
	packet_set_interactive( 0 );

	//printf ( "supported_authentications = %d\n", (supported_authentications & (1 << SSH_AUTH_TIS)));
	//printf ( "supported_authentications = %d\n", (supported_authentications & (1 << SSH_AUTH_PASSWORD)));

	/* Add */
	if( !original_mode_flag && radius_flag == 1 ) target_auth( sock, sp, &client_session_id_arg );

	/* Add */

	printf( "auth ok\n" );
	/* Signal connection to parent */
	kill( getppid(), SIGUSR1 );
	char *pt;

	for( i = 0; i < aareq_cnt; i++ )
	{
		printf( "no empty req\n" );
		writen( sp, &aareq_cpy[i], aareq_cpy[i].len + 8 );
	}

	for( i = 0; i < data_cnt; i++ )
	{
		printf( "no empty date\n" );
		writen( sp, &data_cpy[i], data_cpy[i].len + 8 );
	}

	FD_ZERO( &readset );
	FD_SET( sock, &readset );
	FD_SET( sp, &readset );

	/* Max file descriptor */
	nfd = ( sp > sock ? sp : sock ) + 1;

	memset( &spkt, 0x00, sizeof( spkt ) );

	for( ;; )
	{
		fd_set readtmp;

		memcpy( &readtmp, &readset, sizeof( readtmp ) );

		debug4( "[FREESVR-SSH-PROXY] Selecting on client side" );

		if( select( nfd, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		/* Read from socketpair and write to server */
		if( FD_ISSET( sp, &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading spkt header on client side" );

			if(( n = readn( sp, &spkt, 8 ) ) <= 0 )
				break;

			if( spkt.len > sizeof( spkt.data ) )
			{
				fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
						spkt.len, sizeof( spkt.data ) );
			}

			debug3( "[FREESVR-SSH-PROXY] Got %u bytes from server process", spkt.len );

			if( spkt.len && ( n = readn( sp, spkt.data, spkt.len ) ) <= 0 )
				break;

			/* add for H3C */
			u_int32_t proxy2client_sessionid;

			proxy2client_sessionid = get_u32(&(spkt.data[0]));
			u_char replace_buf[4];
			int j;
			if( spkt.type >= 91 && spkt.type <= 100 && proxy2client_sessionid == proxy_server_session_id )
			{
				put_u32( replace_buf, session_map[client_session_id_arg] );
				//put_u32( replace_buf, 256 );
				for( j = 0; j < 4; j++ )
				{
					spkt.data[j] = replace_buf[j];
				}
			}

			packet_start( spkt.type );
			packet_put_raw( spkt.data, spkt.len );
			packet_send();
			packet_write_wait();
			memset( &spkt, 0x00, spkt.len + 8 );
		}

		/* Read from target and write to socketpair */
		if( FD_ISSET( sock, &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading from client on client side" );

			while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
			{
				pt = packet_get_raw( &spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				memcpy( spkt.data, pt, spkt.len );
				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );

				if( writen( sp, &spkt, spkt.len + 8 ) != spkt.len + 8 )
					break;

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}
	}

	if( errno && n )
		logit( "** Error: %s\n", strerror( errno ) );

	packet_close();
	exit( errno ? EXIT_FAILURE : EXIT_SUCCESS );
}
