<!--[if !IE]>start quick info<![endif]-->
<div class="quick_info">
    <div class="quick_info_top">
        <h2>Quick info</h2>
    </div>
    <div class="quick_info_content">
        <dl>
            <dt>Support Ticket Details</dt><br />
            <dd></dd>
        </dl>
		<br />
		 <?php $open_tickets = $db->get_var("SELECT count(*) FROM support WHERE username = '$username' AND read_status = '1'") ; ?>
		<dl>
            <dt><?php echo $open_tickets; ?></dt>
            <dd>Ticket(s) Requiring Attention</dd>
        </dl>
		<br />
		 <?php $closed_tickets = $db->get_var("SELECT count(*) FROM support WHERE username = '$username' AND read_status = '0'") ; ?>
        <dl>
            <dt><?php echo $closed_tickets; ?></dt>
            <dd>Closed Ticket(s)</dd>
        </dl>

    </div>
    <span class="quick_info_bottom"></span>
</div>
<!--[if !IE]>end quick info<![endif]-->