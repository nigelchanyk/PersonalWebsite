<?php
$mail_title = '';
$email_content = '';

// Set email variables
$email_to = 'nigel@nigelchan.ca';

// Set required fields
$required_fields = array('sender','email','title','message');

// Set form status
$form_complete = FALSE;

// configure validation array
$validation = array();

// check form submittal
if(!empty($_POST)) {
	// Sanitise POST array
	foreach($_POST as $key => $value) $_POST[$key] = remove_email_injection(trim($value));
	
	// Loop into required fields and make sure they match our needs
	foreach($required_fields as $field) {		
		// the field has been submitted?
		if(!array_key_exists($field, $_POST)) array_push($validation, $field);
		
		// check there is information in the field?
		if($_POST[$field] == '') array_push($validation, $field);
		
		// validate the email address supplied
		if($field == 'email') if(!validate_email_address($_POST[$field])) array_push($validation, $field);
	}
	
	// basic validation result
	if(count($validation) == 0) {
		
		// simple email content
		foreach($_POST as $key => $value) {
			if($key != 'submit') $email_content .= $key . ': ' . $value . "\n";
			if($key == 'title') $mail_title = $value;
		}
		
		// if validation passed ok then send the email
		mail($email_to, $mail_title, $email_content);
		
		// Update form switch
		$form_complete = TRUE;
	}
}

function validate_email_address($email = FALSE) {
	return (preg_match('/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i', $email))? TRUE : FALSE;
}

function remove_email_injection($field = FALSE) {
   return (str_ireplace(array("\r", "\n", "%0a", "%0d", "Content-Type:", "bcc:","to:","cc:"), '', $field));
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="css/contact.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript">
		var compatibleStyles = 'css/contact_compatible.css';
    </script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/modernizr.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>
    <title>Nigel Chan's Personal Website</title>
</head>

<body>
	
    <div id="wrapper">
		<div id="site-title">
        	<div id="title-image"></div>
            <div id="quote-block">
				<div id="quote">Enable javascript for cool effects!</div>
                <div id="responsive-status">
                	Responsive Web Design in Action!
                </div>
            </div>
        </div>
        
        <div id="topnav-div">
            <div class="left">
                <div class="right">
                    <div class="center">
                        <div id="drop-down-trigger">
                            Site Navigator
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="nav-item-frame">
            <ul class="topnav">
                <li><a href="/">
                    <div class="left">
                        <div class="right">
                            <div class="center">
                            	<div>Home</div>
                            </div>
                        </div>
                    </div>
                </a></li>
                <li><a href="about.html">
                    <div class="left">
                        <div class="right">
                            <div class="center">
                            	<div>About Me</div>
                            </div>
                        </div>
                    </div>
                </a></li>
                <li><a href="resume.html">
                    <div class="left">
                        <div class="right">
                            <div class="center">
                            	<div>Résumé</div>
                            </div>
                        </div>
                    </div>
                </a></li>
                <li><a href="projects.html">
                    <div class="left">
                        <div class="right">
                            <div class="center">
                            	<div>Projects</div>
                            </div>
                        </div>
                    </div>
                </a></li>
                <li>
                    <div class="left">
                        <div class="right">
                            <div class="center">
                            	<div>Contact Me</div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        
        <div id="content">
			<?php if($form_complete === FALSE): ?>
            <form action="contact.php" method="post" id="email_form">
                <div class="title-large">
                	<div>
                    	<h2>Complete the code below to send me an email</h2>
                    </div>
                </div>
                <div class="code">
                <p><span class="reserved">public class</span> <span class="class">Email</span> : <span class="class">Form</span> {</p>
                <div class="indent">
                    <p><span class="reserved">private</span> <span class="class">string</span> SenderFullName;</p>
                    <p><span class="reserved">private</span> <span class="class">string</span> SenderEmailAddress;</p>
                    <p><span class="reserved">private</span> <span class="class">string</span> EmailTitle;</p>
                    <p><span class="reserved">private</span> <span class="class">string</span> EmailMessage;</p>
                    <br/>
                    <p><span class="reserved">public</span> <span class="method">Email</span>() {</p>
                    <div class="indent">
                        <p><span id="sender_error" class="error"></span></p>
                        <p>SenderFullName = <span class="quote">"</span><input id="sender" class="textfield" type="text" name="sender" value="<?php echo isset($_POST['sender'])? $_POST['sender'] : ''; ?>"/><span class="quote">"</span>;</p>
                        <p><span id="email_error" class="error"></span></p>
                        <p>SenderEmailAddress = <span class="quote">"</span><input id="email" class="textfield" type="text" name="email" value="<?php echo isset($_POST['email'])? $_POST['email'] : ''; ?>"/><span class="quote">"</span>;</p>
                        <p><span id="title_error" class="error"></span></p>
                        <p>EmailSubject = <span class="quote">"</span><input id="title" class="textfield" type="text" name="title" value="<?php echo isset($_POST['title'])? $_POST['title'] : ''; ?>" /><span class="quote">"</span>;</p>
                        <p><span id="message_error" class="error"></span></p>
                        <p>EmailMessage = <span class="quote">"</span></p>
                        <div>
                            <textarea id="message" class="textarea" type="text" name="message" value="<?php echo isset($_POST['message'])? $_POST['message'] : ''; ?>"></textarea>
                        </div><span class="quote">"</span>;
                    </div>
                    <p>}</p>
                    <br/>
                    <p><span class="reserved">public void</span> <span class="method">Submit</span>() {</p>
                    <div class="indent">
                        <p><span class="reserved">base</span>.Submit(toString());</p>
                    </div>
                    <p>}</p>
                    <br/>
                    <p><span class="reserved">public override string</span> <span class="method">toString</span>() {</p>
                    <div class="indent">
                        <p><span class="reserved">return </span> <span class="quote">"Sender: "</span> + SenderFullName + <span class="quote">"\nEmail: "</span> + SenderEmailAddress + <span class="quote">"\nSubject: "</span> + EmailSubject + <span class="quote">"\nMessage: "</span> + EmailMessage);</p>
                    </div>
                    <p>}</p>
                </div>
                <p>}</p>
                </div>
                <input id="form_submission" name="form_submission" type="button" value="Execute Submit()" onClick="submitIfValid()"/>
            </form>
            <?php else: ?>
            <div class="title-large">
            	<div>
                	<h2>Email Submitted Successfully</h2>
                </div>
            </div>
            <div class="feedback">
            	<p>Thank you for your message. I will try to reply as soon as possible.</p>
            </div>
            <?php endif; ?>
            <div class="text-area credit">
            	Special thanks to <b>James Brand</b>, who created an awesome tutorial on PHP contact form.<br/>
                If you are interested in his tutorials, please visit <a href="http://www.dreamweavertutorial.co.uk" target="_blank">http://www.dreamweavertutorial.co.uk</a>
            </div>
        </div>
        <div id="copyright">
        	<p class="footer-text">© 2012 Yin Ki Nigel Chan</p>
        </div>
        
    </div>
    
</body>

</html>
