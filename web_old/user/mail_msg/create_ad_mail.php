<div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box; font-size:14px; width:100%!important; height:100%; line-height:1.6em; background-color:#f6f6f6; margin:0; padding:0" bgcolor="#f6f6f6">
<style type="text/css">
  table.table-ads th{
    padding: 5px;
  }
  table.table-ads td{
    padding: 5px;
  }
  table.table-ads {
    font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size:13px!important; 
    text-align:left;
  }
  
  ul li{
    list-style: none!important;
  }

  ul li::before {
  color: #5121ad!important;  
  /* color of bullet or square */
  content: "\2022"!important;  /* Add content: \2022 is the CSS Code/unicode for a bullet */
  font-weight: bold!important; /* If you want it to be bold */
  font-size: 1.2em!important; /* If you want it to be bold */
  display: inline-block!important; /* Needed to add space between the bullet and the text */ 
  width: 1.5em!important; /* Also needed for space (tweak if needed) em or %**/
  margin-left: -1em!important; /* Also needed for space (tweak if needed) */

}
</style>
<table style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; width:100%; background-color:#f6f6f6; margin:0" align="center" bgcolor="#f6f6f6">
  <tbody>
    <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
      <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0" valign="top"></td>
      <td width="600" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; display:block!important; max-width:600px!important; clear:both!important; width:100%!important; margin:0 auto; padding:0" valign="top">
        <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; max-width:600px; display:block; margin:0 auto; padding:0">
          <table width="100%" cellpadding="0" cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; border-radius:3px; background-color:#fff; margin:0; border:1px solid #e9e9e9" bgcolor="#fff">
            <tbody>
              <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:20px; vertical-align:top; color:#fff; font-weight:500; text-align:center; border-radius:3px 3px 0 0 ; background-color:#FFF; margin:0; padding:20px;" align="center" bgcolor="#ffffff" valign="top">
                <img class="img img-responsive" height="40px" style='padding:10px;' src="<?php echo base_url('theme/web/images/logo.png'); ?>">
                </td>
              </tr>
              <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:15px; vertical-align:top; text-transform:uppercase; color:#000; font-weight:700; text-align:center; background-color:#fbd800; margin:0; padding:5px" align="center" bgcolor="#ddf6ff" valign="top">
                <?=$msg_title;?>
                </td>
              </tr>
              <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:10px" valign="top">
                  <table width="100%" cellpadding="0" cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0; padding: 5px;">
                    <tbody>
                      <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px ;vertical-align:top; margin:0; padding:0 0 20px" valign="top">
                        Hello,  
                        <span style="font-weight: bold!important;"><?= $name; ?></span>
                        </td>
                      </tr>
                      <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:0 0 20px" valign="top">
                        <?= $msg;?>
                        </td>
                      </tr>
                      <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0;">
                          <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:10px" valign="top">
                              <table width="100%" cellpadding="0" cellspacing="0" border="1" style="margin: 0px; text-align: center;">
                                  <caption style="text-align: left;">Transaction Details</caption>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Txt ID</td><td>Amount</td><td>Status</td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;"><?= $txt_id?></td><td><?= $amount; ?>.00 $</td><td style="color:green;"><?= $status; ?></td>
                                  </tr>
                                  
                              </table>
                            </td>
                      </tr>
                      <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0;">
                          <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:10px" valign="top">
                              <table width="100%" cellpadding="0" cellspacing="0" border="1" style="margin: 0px; text-align: center;">
                                  <caption style="text-align: left;">Advertisement Details</caption>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Business Name</td><td>:</td><td><?= $b_name; ?></td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Business Title</td><td>:</td><td><?= $b_title; ?></td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Email ID</td><td>:</td><td><?= $email; ?></td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Phone No.</td><td>:</td><td><?= $phone; ?></td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Address</td><td>:</td><td><?= $address; ?></td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Post Code</td><td>:</td><td><?= $post_code; ?></td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 5px; width: 30%;">Date of payment</td><td>:</td><td><?= date('l,F d, Y'); ?></td>
                                  </tr>
                              </table>
                            </td>
                      </tr>
                      <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:0 0 20px" valign="top">&nbsp;<br>&nbsp;<br>
                          <a href="<?=base_url("login");?>" style="padding:10px 18px; border-radius:10px; background-color:#fbd800; text-decoration:none; color:#000" target="_blank" data-saferedirecturl="">Login to YellowVdo</a>
                            &nbsp;<br>&nbsp;<br>
                        </td>
                      </tr>
                      <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:20px 0 20px" valign="top">
                        <!-- &nbsp;<br><?=$thanks_msg;?> -->
                        
                        </td>
                      </tr>
                      <!-- <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:20px 0 20px" valign="top">
                        &nbsp;<br>If you haven't requested a password reset, reply to this email to notify our support team.
                         &nbsp;<br>&nbsp;<br>
                        </td>
                      </tr> -->
                    </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; width:100%; clear:both; color:#999; margin:0; padding:20px">
          <table width="100%" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
            <tbody>
              <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:12px; vertical-align:top; color:#999; text-align:center; margin:0; padding:0 0 20px" align="center" valign="top">
                     You're receiving this email because you have an account on Yellow VDO. 
                  <!-- <br><a style="text-decoration:underline; color:#999">Unsubscribe</a> to stop receiving these emails.<br style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0"> -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </td>
    <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;margin:0" valign="top"></td>
  </tr>
</tbody>
</table>

<!-- <p><?= $ignore_msg;?>  -->
<!-- <a href="https://u1012957.ct.sendgrid.net/wf/unsubscribe?upn=H-2BTmCgIoAw21bIcc6uUqQxbmxHMagCwpcI-2Bqy-2FJQkGYXL-2BcQeCPZ4mlLb-2Fm8IVC49OLHG8sCM-2FCp8baivL7P-2FpsnVGudEiONt15BXgsJm7p2WPgVlLbeM2M6FU7iuXX5S0nuGe59yuHl3L6YmM1auYJ6aVipyPGgQc2gOJXWMqimvv1UmOJrGt7MSxxwKzNz6dh-2BuTIGYmfccnr-2B-2F23a9edF3LsRxy8TQn63pAVbXz4-3D" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://u1012957.ct.sendgrid.net/wf/unsubscribe?upn%3DH-2BTmCgIoAw21bIcc6uUqQxbmxHMagCwpcI-2Bqy-2FJQkGYXL-2BcQeCPZ4mlLb-2Fm8IVC49OLHG8sCM-2FCp8baivL7P-2FpsnVGudEiONt15BXgsJm7p2WPgVlLbeM2M6FU7iuXX5S0nuGe59yuHl3L6YmM1auYJ6aVipyPGgQc2gOJXWMqimvv1UmOJrGt7MSxxwKzNz6dh-2BuTIGYmfccnr-2B-2F23a9edF3LsRxy8TQn63pAVbXz4-3D&amp;source=gmail&amp;ust=1532669764212000&amp;usg=AFQjCNGs7wZi5hNl5nRyUlaAg4tfXz5Zrw">click here</a>. -->
</p>
<div class="yj6qo ajU">
  <div id=":1eo" class="ajR" role="button" tabindex="0" aria-label="Show trimmed content" data-tooltip="Show trimmed content">
    <img class="ajT" src="//ssl.gstatic.com/ui/v1/icons/mail/images/cleardot.gif">
  </div>
</div>
<span class="HOEnZb adL">
  <font color="#888888">

  </font>
</span>
</div>