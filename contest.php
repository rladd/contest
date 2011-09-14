<div id="contentDetails">
<?php 
    include('include_functions.php'); 
    include('include_config.php'); 
    include('include_db.php');

    // Set default values for required vars
    if (!isset($_POST['formMode'])) { $_POST['formMode'] = "normal"; }
    $formMode = $_POST['formMode'];

?>
<script type="text/javascript">

function validateContestForm()
{

    // Define the highlight color
    var highlightColor = '#FF0000';
    var borderColor = '#000';
    var errorColor = '#FF000000';
    var successColor = '#00aa00';
    var formValid = true;

    // Init our variables
    var objFirstName    = document.getElementById('firstName');
    var objLastName     = document.getElementById('lastName');
    var objPhone        = document.getElementById('phone');
    var objEmail        = document.getElementById('emailAddress');
    var objAgree        = document.getElementById('agree');
    var objSubmit       = document.getElementById('submitButton');
    var objErrorLabel   = document.getElementById('errorLabel');
    var strErrors       = "";
    var strMissingField = '* One or more form fields has not yet been entered.';

    // Define the error fields
    var objErrorFirstName   = document.getElementById('errorFirstName');
    var objErrorLastName    = document.getElementById('errorLastName');
    var objErrorPhone       = document.getElementById('errorPhone');
    var objErrorEmail       = document.getElementById('errorEmail');
    var objErrorAgree       = document.getElementById('errorAgree');

    // Update the border color of the form fields which have not been fulfilled
    if (objFirstName.value == '') { 
        objErrorFirstName.innerHTML = '*';
        objErrorFirstName.style.color = errorColor;
        objFirstName.style.borderColor = highlightColor; 
        formValid = false; 
    }
    else { 
        objErrorFirstName.innerHTML = '';
        objFirstName.style.borderColor = borderColor; 
        strErrors = strMissingField; 
    }

    /* Validate the "lastName" form field */
    if (objLastName.value == '') { objLastName.style.borderColor = highlightColor; formValid = false; objErrorLastName.innerHTML = '*';  } 
    else { objLastName.style.borderColor = borderColor; objErrorLastName.innerHTML=''; }

    /* Validate the "phoneNumber" form field */
    if (objPhone.value == '') { objPhone.style.borderColor = highlightColor; formValidd = false; objErrorPhone.innerHTML = '*'; }
    else { objPhone.style.borderColor = borderColor; objErrorPhone.innerHTML = ''; }

    /* Email / Address validation */
    if (objEmail.value == '') { 
        objEmail.style.borderColor  = highlightColor;
        formValid = false; 
        objErrorEmail.innerHTML = '*';
    }
    else { 
        objEmail.style.borderColor  = borderColor;
        objErrorEmail.innerHTML = '';
    }

    // Check to make sure the user has agreed to terms and conditions
    if (objAgree.checked != true)
    {
        //objAgree.style.borderColor = highlightColor;
        //strErrors = strErrors +  "In order to submit your contest entry, you must agree to the contest rules and regulations.";
        objErrorAgree.innerHTML = '*';
        formValid = false;
    }
    else {
        objErrorAgree.innerHTML = '';
    }

    // Enable the submit button if the form is valid
    if (formValid == true) { objSubmit.disabled = false;  }
        
    // If the form is invalid, disable the submission button and output the problem...    
    if (formValid == false) {   
        objSubmit.disabled = true;
        objErrorLabel.style.color = highlightColor;
        objErrorLabel.innerHTML = strErrors;   
    }
    else {
        objErrorLabel.style.color = successColor;
        objErrorLabel.innerHTML = 'Thank you for your entry!';
    }

}

</script>

<?php 

    if (!isset($_POST['formMode'])) { $_POST['formMode'] = "normal"; }

    if ($formMode == "submit")
    {
        // Check for any null values within the form and set a default value (radio boxes / check boxes / etc)
        if (!isset($_POST['offer'])) { $_POST['offer'] = 0; }
        if (!isset($_POST['agree'])) { $_POST['agree'] = 0; }

        // Load the post data from the form submission. We'll addslashes to protect the database from any injection scripts / hostile input.
        $arrResults['firstName']['title'] = "First Name";
        $arrResults['firstName']['value'] = addslashes($_POST['firstName']);
        $arrResults['lastName']['title'] = "Last Name";
        $arrResults['lastName']['value'] = addslashes($_POST['lastName']);
        $arrResults['phone']['title'] = "Phone";
        $arrResults['phone']['value'] = addslashes($_POST['phone']);
        $arrResults['email']['title'] = "Email";
        $arrResults['email']['value'] = addslashes($_POST['emailAddress']);
        $arrResults['agree']['title'] = "Agree"; 
        $arrResults['agree']['value'] = addslashes($_POST['agree']);
        $arrResults['timestamp']['title'] = "Timestamp"; 
        $arrResults['timestamp']['value'] = mktime();
        $arrResults['date']['title'] = "Date";
        $arrResults['ipaddress']['title'] = "IP Address"; 
        $arrResults['ipaddress']['value'] = addslashes($_SERVER['REMOTE_ADDR']);
        $arrResults['contestId']['title'] = "Contest ID"; 
        $arrResults['contestId']['value'] = addslashes($arrConfig['contest_id']);
        $arrResults['referral']['title'] = "Referral Url"; 
        $arrResults['referral']['value'] = addslashes($_SERVER['HTTP_REFERER']);
        $arrResults['date']['title'] = "Date";
        $arrResults['date']['value'] = date("Y-m-d h:i", mktime());

        if ($arrResults['agree']['value'] == "on") { $arrResults['agree']['value'] = "1"; }

        // Build our query to insert our new record.
        $query = "INSERT INTO results (strFirstName, strLastName, strPhone, strEmail, fynAgree, timestamp, ipaddress, contestId, strReferralUrl) ";
        $query.= "VALUES(";
        $query.= "'" . $arrResults['firstName']['value'] . "', ";
        $query.= "'" . $arrResults['lastName']['value'] . "', ";
        $query.= "'" . $arrResults['phone']['value'] . "', ";
        $query.= "'" . $arrResults['email']['value'] . "', ";
        $query.= "'" . $arrResults['agree']['value'] . "', ";
        $query.= "'" . $arrResults['timestamp']['value'] . "', ";
        $query.= "'" . $arrResults['ipaddress']['value'] . "', ";
        $query.= "'" . $arrResults['contestId']['value'] . "', ";
        $query.= "'" . $arrResults['referral']['value'] . "' ";
        $query.= "); ";

        // Execute the query and insert our new record.
        db_query($query);

	// Debug the query
	#print("MySQL Error: " . mysql_error() . "<br/>\r\n");	

        // Perform any email based translations
        #$arrResults['date']['title'] = "Date";
        #$arrResults['date']['value'] = date("Y-m-d h:i", mktime());

        // Send the email to the defined recipients.
        sendEmail($arrConfigEmail, $arrResults);

    }

?>
<style type="text/css">
#contestWrapper {
    text-align:center;
    width:100%;
    padding-left:26px;
}
#contestForm { 
    text-align:left;
    font-size:10px; 
    width:434px;
}
#contestForm input {
    border: 1px solid #0c276c;
    background-color:#fff;
}
#contestBanner {
    text-align:center;
}
#contestContent { 
    width:434px; 
    padding-top:20px;
}
#contestThanks {
    text-align:center;
    font-style:bold;
    font-size:20px;
}
.contestTitle {
    border-bottom-width:1px;
    border-bottom-style:solid; 
    margin-bottom:10px;
}
.contestRules a { font-weight:bold; }
.contestRules a:hover { text-decoration:underline; }

.fieldLabel { width:240px; }
#errorLabel { padding-left:10px; color:#ff0000; }

.formLabel { width:70px; display:inline-block; float:left; }
.formLabelAddress { float:left; }
.formError { width:8px; display:inline-block; float:left; color:red; }

</style>

<div id="contestForm">
<form method="post">

<!-- Submission acceptance message -->
<?php if ($formMode == "submit"): ?>
<div id="contestContent">

<table class="contestTable" width="100%">
<tr class="contestRow">
<td colspan="5"><strong></h2>Thank you for your contest entry!</h2></strong></td>
</tr>
</table>

<?php else: ?>
<!-- Default form display -->

<div id="contestBanner"><a href="contest/<?php print($arrConfig['contest_rules']); ?>" target="_new"><img src="contest/<?php print($arrConfig['header_image']); ?>" /></a></div>
<div id="contestContent">

<table class="contestTable" width="100%">
<tr class="contestRow">
<td colspan="5"><h4><?php print($arrConfig['header_text']); ?></h4></h4></td>
</tr>


<tr class="contestRow">
<td class="fieldLabel">
    <div class="formLabel">First Name</div><div id="errorFirstName" class="formError">&nbsp;</div>
</td>
<td><input type="text" name="firstName" id="firstName" size="16" maxlength="40" value="" onKeyUp="validateContestForm()"  /></td>
<td width="2">&nbsp;</td>
<td class="fieldLabel"><div class="formLabel">Last Name</div><div id="errorLastName" class="formError">&nbsp;</div></td>
<td><input type="text" name="lastName" id="lastName" size="16" maxlength="40" value="" onKeyUp="validateContestForm()" /></td>
</tr>

<tr class="contestRow">
<td class="fieldLabel"><div class="formLabel">Phone</div><div id="errorPhone" class="formError">&nbsp;</div></td>
<td><input type="text" name="phone" id="phone" size="16" maxlength="40" value="" onKeyUp="validateContestForm()" /></td>
<td>&nbsp;</td>
<td class="fieldLabel"><div class="formLabel">Email</div><div id="errorEmail" class="formError">&nbsp;</div></td>
<td><input type="text" name="emailAddress" id="emailAddress" size="16" maxlength="40" value="" onKeyUp="validateContestForm()" /></td>
</tr>
</table>
<br/>

<!-- Contest Rules and acceptance -->
<table class="contestRules">

<tr>
<td><input type="checkbox" name="agree" id="agree" onClick="validateContestForm();"; /></td>
<td>Yes, I have read and agree to all <a href="contest/<?php print($arrConfig['contest_rules']); ?>" target="_new">contest rules</a> and regulations.<div class="formError" id="errorAgree">&nbsp;</div></td>
</tr>

<tr><td colspan="2">&nbsp;</td></tr>
</table>

<!-- Form Submission -->
<table>
<tr>
<td class="contestSubmit">
    <input type="submit" id="submitButton" name="submitButton" value="Submit" disabled="true" /> 
</td>
<td>
    <div id="errorLabel"></div>
</td>
</tr>
</table>


<input type="hidden" name="formMode" value="submit" />
<?php endif; ?>
</form>
<br/><br/>
</div>
</div>
</div>
