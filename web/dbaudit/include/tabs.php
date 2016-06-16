<?php
$tab =array(
			'c_admin_sqlnet_search'=>array(
				array(
				'tabname'=> 'c_admin_sqlnet_search',
				'url'=>'admin.php?controller=admin_sqlnet&action=search',
				'title'=> '审计查询'
				)
			),
			'c_admin_sqlnet'=> array(
				array(
				'tabname'=> 'c_admin_sqlnet',
				'url'=>'admin.php?controller=admin_sqlnet',
				'title'=> 'Oracle'
				),
				array(
				'tabname'=> 'c_admin_db2',
				'url'=>'admin.php?controller=admin_db2',
				'title'=> 'DB2'
				),
				array(
				'tabname'=> 'c_admin_sqlserver',
				'url'=>'admin.php?controller=admin_sqlserver',
				'title'=> 'SQL Server'
				),
				array(
				'tabname'=> 'c_admin_sybase',
				'url'=>'admin.php?controller=admin_sybase',
				'title'=> 'Sybase'
				),
				array(
				'tabname'=> 'c_admin_mysql',
				'url'=>'admin.php?controller=admin_mysql',
				'title'=> 'MySQL'
				)
			),
			'c_admin_sqlneton'=> array(
				array(
				'tabname'=> 'c_admin_sqlneton',
				'url'=>'admin.php?controller=admin_sqlneton',
				'title'=> 'Oracle'
				),
				array(
				'tabname'=> 'c_admin_db2on',
				'url'=>'admin.php?controller=admin_db2on',
				'title'=> 'DB2'
				),
				array(
				'tabname'=> 'c_admin_sqlserveron',
				'url'=>'admin.php?controller=admin_sqlserveron',
				'title'=> 'SQL Server'
				),
				array(
				'tabname'=> 'c_admin_sybaseon',
				'url'=>'admin.php?controller=admin_sybaseon',
				'title'=> 'Sybase'
				),
				array(
				'tabname'=> 'c_admin_mysqlon',
				'url'=>'admin.php?controller=admin_mysqlon',
				'title'=> 'MySQL'
				)
			),
			'c_admin_ipgroup'=> array(
				array(
				'tabname'=> 'c_admin_ipgroup',
				'url'=>'admin.php?controller=admin_ipgroup',
				'title'=> 'IP地址组'
				)
			),
			'c_admin_sqloptions'=> array(
				array(
				'tabname'=> 'c_admin_sqloptions',
				'url'=>'admin.php?controller=admin_sqloptions',
				'title'=> 'SQL命令组'
				)
			),
			'c_admin_blacklist'=> array(
				array(
				'tabname'=> 'c_admin_blacklist',
				'url'=>'admin.php?controller=admin_blacklist',
				'title'=> '过滤列表'
				)
			),
			'c_admin_auditpolicy'=> array(
				array(
				'tabname'=> 'c_admin_auditpolicy_oracle',
				'url'=>'admin.php?controller=admin_auditpolicy&dbtype=oracle',
				'title'=> 'Oracle审计规则'
				),
				array(
				'tabname'=> 'c_admin_auditpolicy_mysql',
				'url'=>'admin.php?controller=admin_auditpolicy&dbtype=mysql',
				'title'=> 'MySQL审计规则'
				),
				array(
				'tabname'=> 'c_admin_auditpolicy_sqlserver',
				'url'=>'admin.php?controller=admin_auditpolicy&dbtype=sqlserver',
				'title'=> 'SQL Server审计规则'
				),
				array(
				'tabname'=> 'c_admin_sqlservercfg',
				'url'=>'admin.php?controller=admin_sqlservercfg',
				'title'=> 'SQL Server配置'
				)
			),
			'c_admin_dbsniffer'=> array(
				array(
				'tabname'=> 'c_admin_dbsniffer',
				'url'=>'admin.php?controller=admin_dbsniffer',
				'title'=> '探针管理'
				)
			),
			'c_admin_dbserver'=> array(
				array(
				'tabname'=> 'c_admin_dbserver',
				'url'=>'admin.php?controller=admin_dbserver',
				'title'=> '数据库'
				)
			),
			'c_admin_member'=> array(
				array(
				'tabname'=> 'c_admin_member',
				'url'=>'admin.php?controller=admin_member',
				'title'=> '用户管理'
				)
			),'c_admin_log'=> array(
				array(
				'tabname'=> 'c_admin_log',
				'url'=>'admin.php?controller=admin_log',
				'title'=> 'Admin操作'
				)
			),
			'c_admin_config'=> array(
				
				array(
				'tabname'=> 'syslog_mail_alarm',
				'url'=>'admin.php?controller=admin_config&action=syslog_mail_alarm',
				'title'=> '告警配置'
				)
			),
			'c_admin_eth'=> array(
				array(
				'tabname'=> 'config_eth',
				'url'=>'admin.php?controller=admin_eth&action=config_eth',
				'title'=> 'eth0'
				),
				array(
				'tabname'=> 'config_ethx',
				'url'=>'admin.php?controller=admin_eth&action=config_ethx',
				'title'=> 'eth1'
				),
				array(
				'tabname'=> 'config_route',
				'url'=>'admin.php?controller=admin_eth&action=config_route',
				'title'=> '静态路由'
				)
			),
			'c_admin_sysmanage'=> array(
				array(
				'tabname'=> 'serverstatus',
				'url'=>'admin.php?controller=admin_sysmanage&action=serverstatus',
				'title'=> '服务状态'
				),
				array(
				'tabname'=> 'upgradeServerStatus',
				'url'=>'admin.php?controller=admin_sysmanage&action=upgradeServerStatus',
				'title'=> '系统升级'
				),
				array(
				'tabname'=> 'info',
				'url'=>'admin.php?controller=admin_sysmanage&action=info',
				'title'=> '系统利用率'
				)
			),
			'c_admin_backup'=> array(
				array(
				'tabname'=> 'table',
				'url'=>'admin.php?controller=admin_backup',
				'title'=> '备份管理'
				),
				array(
				'tabname'=> 'del_session_table',
				'url'=>'admin.php?controller=admin_backup&action=del_session_table',
				'title'=> '数据删除'
				)
			),
			'c_admin_loginaccount'=> array(
				array(
				'tabname'=> 'day',
				'url'=>'admin.php?controller=admin_loginaccount',
				'title'=> '天报表'
				),
				array(
				'tabname'=> 'week',
				'url'=>'admin.php?controller=admin_loginaccount&action=week',
				'title'=> '周报表'
				),
				array(
				'tabname'=> 'month',
				'url'=>'admin.php?controller=admin_loginaccount&action=month',
				'title'=> '月报表'
				)
			),
			'c_admin_sqlaccount'=> array(
				array(
				'tabname'=> 'day',
				'url'=>'admin.php?controller=admin_sqlaccount',
				'title'=> '天报表'
				),
				array(
				'tabname'=> 'week',
				'url'=>'admin.php?controller=admin_sqlaccount&action=week',
				'title'=> '周报表'
				),
				array(
				'tabname'=> 'month',
				'url'=>'admin.php?controller=admin_sqlaccount&action=month',
				'title'=> '月报表'
				)
			)
		);
$tab['c_admin_db2']=$tab['c_admin_sqlnet'];
$tab['c_admin_sqlserver']=$tab['c_admin_sqlnet'];
$tab['c_admin_sybase']=$tab['c_admin_sqlnet'];
$tab['c_admin_mysql']=$tab['c_admin_sqlnet'];
$tab['c_admin_db2on']=$tab['c_admin_sqlneton'];
$tab['c_admin_sqlserveron']=$tab['c_admin_sqlneton'];
$tab['c_admin_sybaseon']=$tab['c_admin_sqlneton'];
$tab['c_admin_mysqlon']=$tab['c_admin_sqlneton'];
$tab['c_admin_sqlservercfg']=$tab['c_admin_auditpolicy'];

$tab['c_admin_db2_search']=$tab['c_admin_sqlnet_search'];
$tab['c_admin_db2_search']=$tab['c_admin_sqlnet_search'];
$tab['c_admin_sqlserver_search']=$tab['c_admin_sqlnet_search'];
$tab['c_admin_sybase_search']=$tab['c_admin_sqlnet_search'];
$tab['c_admin_mysql_search']=$tab['c_admin_sqlnet_search'];

?>