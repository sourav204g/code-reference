<?php 

function email_template_booking_details($bookingID) {

    $bookingUrl = get_permalink( $bookingID );

    $bookingInfo = file_get_contents($bookingUrl);
    
    return $bookingInfo;
 
}


function email_template__user() {
	return '';

}

function email_template__handyman() {
	return '<style type="text/css">
    
    #outlook a{padding:0;} 
    .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} 
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} 
    body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;}
    table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}
    img{-ms-interpolation-mode:bicubic;}
    
    body{margin:0; padding:0; font-family: Tahoma, sans-serif;}
    img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
    table{border-collapse:collapse !important;}
    body{height:100% !important; margin:0; padding:0; width:100% !important;}
    .appleBody a {color:#68440a; text-decoration: none;}
    .appleFooter a {color:#999999; text-decoration: none;}
    @media print
    {
        .no-print, .no-print *
         {
            display: none !important;
         } 
    }
    @media print  screen and (max-width: 768px) {
        .responsive-table{
            width:100% !important;}

        
            
        table[class="responsive-table"]{
          width:100% !important;
        }
            
        table[class="wrapper"]{
          width:100% !important;
        }
        td[class="logo"]{
          text-align: center;
          padding: 20px 0 20px 0 !important;
        }
        td[class="logo"] img{
          margin:0 auto!important;
        }
        td[class="mobile-hide"]{
          display:none !important;}
          
         span[class="mobile-hide"]{
          display:none !important;}
        img[class="mobile-hide"]{
          display: none !important;
        }
        img[class="img-max"]{
          max-width: 100% !important;
          height:auto !important;
        }
        table[class="responsive-table"]{
          width:100%!important;
        }
        td[class="padding"]{
          padding: 10px 5% 15px 5% !important;
        }
        td[class="padding-copy"]{
          
        }
        td[class="padding-meta"]{
         
        }
        td[class="no-pad"]{
          padding: 0 0 20px 0 !important;
          width:100% !important;
        }
        td[class="no-padding"]{
          padding: 0 !important;
        }
        td[class="section-padding"]{
          padding: 0px 15px 0px 15px !important;
        }
        td[class="section-padding-bottom-image"]{
          padding: 50px 15px 0 15px !important;
        }
        td[class="mobile-wrapper"]{
            padding: 10px 5% 15px 5% !important;
        }
        table[class="mobile-button-container"]{
            margin:0 auto;
            width:100% !important;
        }
        a[class="mobile-button"]{
            width:100% !important;
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
        }
        
        tr[class="table-full"]{
            display: block !important;
            width:100%;
            
        }
        
        td[class="table-full"]{
            display: block !important;
            width:100%;
            text-align:left !important;
            
        }
        table.page-brk{
             page-break-after: always;
        }
    }
    
    
</style><table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#000">
    <tr>
        <td  width="100%">
            <div align="center" style="padding: 0px 15px 0px 15px;">
                <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="700" class="wrapper">
                    <tr>
                        <td style="padding: 20px 0px 20px 0px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center"><a href="https://www.odbus.in/" target="_blank"><img alt="Logo" src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/resource/logo.png"  style="display: block;" border="0"></a></td>
                                    
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr bgcolor="#4caf50">
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="90%" align="center">
                                <tr class="mobile-td">
                                    <td align="left" style="padding: 10px; font-size: 14px; font-family: Tahoma, sans-serif; text-decoration: none;"><a href="tel:+18007261225" style="color: #fff; text-decoration: none; font-weight:bold;">Call us: +1(800)726-1225.</a></td>
                                    
                                    <td align="right" style="padding: 10px; font-size: 14px; font-family: Tahoma, sans-serif; text-decoration: none;"><a href="mailto:support@handymanproservices.com" style="color: #fff; text-decoration: none; font-weight:bold;">Email: support@handymanproservices.com</a></td>
                                    
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td bgcolor="#d2d2d2" align="center"  class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="700" class="responsive-table" bgcolor="#fff" >
                <tbody>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0"  width="90%" align="center" >
                                        <tbody>
                                <tr>
                                     <th align="left" style="font-size: 18px;  color: #0f204c; padding: 30px 10px 10px 10px;" class="padding-copy">
                                        BOOKING ID : HANDYMANPRO9546 </th>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                        <tr style="border-bottom: solid 1px #fff;">
                                            <td align="left" style="padding: 10px; font-size: 14px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">Thanks for choosing Handyman PRO Services, <strong>' . $_POST["hnd_customer_name"] . ' </strong><br><br>
                                            <strong  style="vertical-align: top">Handyman:</strong> 
                                            <span style="vertical-align: top">' . get_field('pros_first_name', $_POST['hndy_pro_id']) . ' ' . get_field('pros_last_name', $_POST['hndy_pro_id']) . '</span><br><br>
                                            <strong  style="vertical-align: top">Booking Date:</strong> 
                                            <span style="vertical-align: top">' . $_POST["hndy_schedule_date"] . '</span><br><br>
                                            <strong  style="vertical-align: top">Time:</strong> 
                                            <span style="vertical-align: top">' . $_POST["hndy_schedule_time"] . '</span>
                                        </td>                                                        
                                        </tr>
                                    </table>
                                </td>
                            </tr>       
                                        
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                        <tr style="border-bottom: solid 1px #fff;">
                                        <th align="center" style="padding: 0px; font-size: 14px; font-family: Tahoma, sans-serif; color: #0f204c; font-weight:bold;"><hr> </th>
                                        </tr>                                     
                                        
                                    </table>
                                </td>
                            </tr>
                                        
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                        <tr style="border-bottom: solid 1px #fff;">
                                            <td align="left" style="padding: 10px; font-size: 14px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                <strong style="vertical-align: top;"> Service Name: </strong> 
                                                <span style="vertical-align: top;">&nbsp; ' . $_POST["new_booking_service_name"] . '</span> 
                                                </td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                        <tr style="border-bottom: solid 1px #fff;">
                                             <td align="left" style="padding: 10px; font-size: 14px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                
                                                 <strong style="vertical-align: top;"> Add-Ons: </strong>
                                                 <span style="vertical-align: top;">' . $_POST["new_booking_selected_service_options"] . '</span>  
                                                </td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                                        
                             
                            
                                        
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                        <tr style="border-bottom: solid 1px #fff;">
                                           <th align="center" style="padding: 0px; font-size: 14px; font-family: Tahoma, sans-serif; color: #0f204c; font-weight:bold;">  <hr> 
                                           </th>
                                        </tr>                                                    
                                                                                            
                                    </table>
                                </td>
                            </tr>                           
                            
                                        
                            <tr>
                             <td>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                <tr style="border-bottom: solid 1px #fff;">
                                  <td align="left" style="padding: 10px; font-size: 15px; font-family: Tahoma, sans-serif; color: #0f204c; font-weight:normal;">
                                    
                                     <strong style="vertical-align: top;"> Client Information</strong>
                                  </td>
                                </tr>   
                               </table>
                              </td>
                            </tr>
                                                                                
                                        
                                        <tr>
                                            <td>
												
												
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                         <td align="left" style="padding: 10px; font-size: 15px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                            <strong style="vertical-align: top;"> Name: </strong>
                                                           ' . $_POST["hnd_customer_name"] . '</td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                                                                
                                        
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                         <td align="left" style="padding: 10px; font-size: 15px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                            <strong style="vertical-align: top;"> Email Address: </strong>
                                                            ' . $_POST["hnd_customer_email"] . '</td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                                                                
                                        
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                         <td align="left" style="padding: 10px; font-size: 15px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                            <strong style="vertical-align: top;"> Phone Number: </strong>
                                                            ' . $_POST["hnd_customer_phone"] . '</td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
											<tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                         <td align="left" style="padding: 10px; font-size: 15px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                            <strong style="vertical-align: top;"> Address: </strong>
                                                           	' . $_POST["hnd_customer_address"] . '</td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
											<tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                         <td align="left" style="padding: 10px; font-size: 15px; font-family: Tahoma, sans-serif; color: #484646; font-weight:normal;">
                                                            <strong style="vertical-align: top;"> Message: </strong>
                                                           ' . $_POST["hnd_customer_message"] . '</td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                                                                
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                        <th align="center" style="padding: 0px; font-size: 14px; font-family: Tahoma, sans-serif; color: #0f204c; font-weight:bold; height:20px;">&nbsp; 
                                                        </th>
                                                    </tr>                                                    
                                                </table>
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                    </table>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                    </td>
                </tr>
            </tbody>
        </table>            
        </td>
    </tr>
</tbody></table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td bgcolor="#d2d2d2" align="center"  class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="700" class="responsive-table" bgcolor="#fff" >
                <tbody>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0"  width="90%" align="center" >
                                        <tbody>
                                        <tr>
                                            <th align="left" style="font-size: 19px;  color: #0f204c; padding: 10px 10px 0px 10px;" class="padding-copy">Terms and Conditions :</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr style="border-bottom: solid 1px #fff;">
                                                        <td align="left" style="padding: 10px; font-size: 13px; font-family: Tahoma, sans-serif; color: #383636; font-weight:normal; text-align: justify;">
                                                        
                                                        <!-- <img src="https://www.odbus.in/frontassets/emailimages/dot.png" /> -->
                                                        <ol>
	<li>
	<p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
	</li>
	<li>
	<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
	</li>
	<li>
	<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 (change this) days\' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
	</li>
	
	
</ol>
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    
                                                    
                                                </table>
                                            </td>
                                        </tr>
                                        
                                        
                                      
                                    </tbody>
                                    </table>
                                </td>
                            </tr>
                            
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
            
        </td>
    </tr>
</tbody></table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="no-print"> 
    <tbody>
    <tr>
        <td bgcolor="#323232" align="center"  class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="700" class="responsive-table" bgcolor="#4caf50" >
                <tbody>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        
                                        <tr class="mobile-td">
                                            <td align="center" style="padding: 10px; font-size: 14px; font-weight:bold; line-height: 25px;  color: #fff;" class="padding-copy"><a href="#" target="_blank" style="color: #fff; text-decoration: none;">Print/SMs/Email Booking Details</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                                <a href="#" target="_blank" style="color: #fff; text-decoration: none;">Cancel Booking</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="#" target="_blank" style="color: #fff; text-decoration: none;">Any Suggestion / Query / Complaint</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </td>
                            </tr>                            
                        </tbody>
                      </table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#323232">
            <div align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="700" class="wrapper">
                    <tr>
                        <td >
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td  width="350" align="left"  style="padding: 10px 0px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="left" style="padding: 0 0 0 20px; font-size: 14px; font-family: Tahoma, sans-serif; text-decoration: none;"><a href="http://www.handymanproservices.com/" target="_blank" style="color: #ffffff; text-decoration: none; font-weight:bold;">
www.handymanproservices.com</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td  width="350" align="right"  style="padding: 10px 0px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr class="no-print">
                                                <td>
                                                   <a target="_blank" href="https://www.facebook.com/">
                                                      <img src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/social-icon/charity-40x40x1.png" style="width: 30px;
    margin-right: 10px;" /></a><td>
                                                <td><a target="_blank" href="https://twitter.com/"><img src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/social-icon/charity-40x40x2.png" style="width: 30px;
    margin-right: 10px;" /></a><td>
                                                <td><a target="_blank" href="https://plus.google.com/"><img src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/social-icon/charity-40x40x3.png" style="width: 30px;
    margin-right: 10px;" /></a><td>
                                                <td><a target="_blank" href="https://www.pinterest.com/"><img src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/social-icon/charity-40x40x5.png" style="width: 30px;
    margin-right: 10px;" /></a><td>
                                                <td><a target="_blank" href="https://www.instagram.com/"><img src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/social-icon/instagram.png" style="width: 30px;
    margin-right: 10px;" /></a><td>
                                                  <td><a target="_blank" href="#">
                                                    <img src="http://dkconnects.com/demo01/handymanpro/wp-content/themes/handyman_pro/assets/images/social-icon/linkedin.png" style="width: 30px;
    margin-right: 10px;" /></a><td>
                                                
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>';


}