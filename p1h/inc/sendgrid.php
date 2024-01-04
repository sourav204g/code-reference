<?php 


                // USER 
                $subject     = 'Service Confirmation Details';
                $contactname = 'Handyman Pro';
                $email_body  = email_template__handyman(); // email_template__user()
                $contactemail = 'noreply@dkconnects.com';

                // Send Grid
                $url = 'https://api.sendgrid.com/';    
                $user = 'getrafic';          
                $pass = 'Emails@2017';                 
                $params = array(          
                    'api_user'  => $user,            
                    'api_key'   => $pass,            
                    'to'        => 'sourav.seoinfotechsolution@gmail.com',                    
                    // 'cc'        => $to_admin1,                    
                    // 'bcc'        => $to_admin2,            
                    'subject'   => $subject,                    
                    'fromname' => $contactname,            
                    'html'      => $email_body,            
                    'text'      => '',            
                    'from'      => '<noreply@dkconnects.com>',          
                    'replyto'      => $contactemail,          
            
                    );
      
                $request =  $url.'api/mail.send.json';        
          
                // Generate curl request         
                $session = curl_init($request);
          
                // Tell curl to use HTTP POST         
                curl_setopt ($session, CURLOPT_POST, true);
          
                // Tell curl that this is the body of the POST          
                curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
          
                // Tell curl not to return headers, but do return the response          
                curl_setopt($session, CURLOPT_HEADER, false);
          
                // Tell PHP not to use SSLv3 (instead opting for TLS)          
                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
          
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
          
                // obtain response
                $response = curl_exec($session);          
                curl_close($session);


                // HANDYMAN
            
            /*  $subject     = 'Job Alert';
                $contactname = 'Handyman Pro';
                $email_body  = email_template__handyman();
                $contactemail = 'noreply@dkconnects.com';

                // Send Grid
                $url = 'https://api.sendgrid.com/';    
                $user = 'getrafic';          
                $pass = 'Emails@2017';                 
                $params = array(          
                    'api_user'  => $user,            
                    'api_key'   => $pass,            
                    'to'        => 'sourav.seoinfotechsolution@gmail.com',                    
                    // 'cc'        => $to_admin1,                    
                    // 'bcc'        => $to_admin2,            
                    'subject'   => $subject,                    
                    'fromname' => $contactname,            
                    'html'      => $email_body,            
                    'text'      => '',            
                    'from'      => '<noreply@dkconnects.com>',          
                    'replyto'      => $contactemail,          
            
                    );
      
                $request =  $url.'api/mail.send.json';        
          
                // Generate curl request         
                $session = curl_init($request);
          
                // Tell curl to use HTTP POST         
                curl_setopt ($session, CURLOPT_POST, true);
          
                // Tell curl that this is the body of the POST          
                curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
          
                // Tell curl not to return headers, but do return the response          
                curl_setopt($session, CURLOPT_HEADER, false);
          
                // Tell PHP not to use SSLv3 (instead opting for TLS)          
                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
          
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
          
                // obtain response
                $response = curl_exec($session);          
                curl_close($session);