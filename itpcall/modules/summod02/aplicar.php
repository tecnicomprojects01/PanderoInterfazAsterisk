<?
                $strHost = "127.0.0.1";
                $strUser = "adminweb";
                $strSecret = "webmanx";
                        $errno=0 ;
                        $errstr=0 ;
                        $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);
                        
                        if (!$oSocket) {
                                echo "$errstr ($errno)<br>\n";
                        } else {
                                                                       
                                fputs($oSocket, "Action: login\r\n");
                                fputs($oSocket, "Username: $strUser\r\n");
                                fputs($oSocket, "Secret: $strSecret\r\n\r\n");                         
                                fputs($oSocket, "Action: command\r\n"); 
				    fputs($oSocket, "Command: reload\r\n\r\n");                                                          
                                usleep(10);                           
                              
                        }
  sleep(1);
  fclose($oSocket);
?>

