freesvr://\"&action=StartMstscAutoRun&host={{$ip}}&port={{$port}}&target_username={{$dusername}}&target_ip={{$ip}}&bpp=16&username={{$username}}&password={{$password}}{{$dynamic_pwd}}&localhost={{$localhost}}&screen={{$screen}}{{if $console eq 'TRUE'}}&rdparg=admin{{/if}}{{if $rdpclipauth_up}}&clipboard=1{{/if}}&disk={{if $rdpdiskauth_up}}{{$member.rdpdisk}}{{/if}}&sid={{$sid}}{{if !$apppub}}&path={{$autorun}} {{$id}}{{else}}&path={{$autorun}}{{/if}}&\"


