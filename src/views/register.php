<!DOCTYPE html>
<html>

<head>
    <title>
        <?=$data['title']?>
    </title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
</head>
</head>
<style>
    body {
        background-color:white;
        overflow: auto;
    }
    
    .panel {
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        padding: 20px;
        padding-bottom: 40px;
        margin: 50px auto;
    }
    
    .btn-secondary {
        background-color: #5FCF80;
        color: white;
        font-weight: bold;
    }
    
    .btn-warning {
        color: white;
        font-weight: bold;
    }
    
    .push-top {
        margin-top: 100px;
    }
    
    .errors {
        color: red;
    }
    
		small{
			color:red;}
</style>

<body>


    
						
							 <div class="col-md-6 col-md-offset-3">
							
							
							<h3><img src="http://www.ncubeschool.org/beta/images/logo.svg" class="centerImage" alt="logo">Ncube School of knowledge</h3>
							
							</div>
							
							
							
						 <div class="container">
							 
						 <div class="row">
                        <div class="col-md-6 col-md-offset-3">
							
							<h3 class="lead">Register yourself</h3>
							<div class="card card-inverse" style="background-color:#E8E6E6">
								<div class="card-block">
                    <form  action="<?=$data['registerAction']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
											
                                            <input  id="first_name" type="text" class="form-control" placeholder="First Name" name="first_name">
                                             <small id="first_name_error" class="form-text text-muted">Should be minimum of 3 characters </small>

                                          </div>
                                          </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text"  id="last_name" class="form-control" placeholder="Last Name" name="last_name">
                                            <small id="last_name_error" class="form-text text-muted">Should be minimum of 3 characters </small>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="username" id="user_name" class="form-control" placeholder="Username" name="username">
                                    <small  id="user_name_error" class="form-text text-muted">Should be minimum of 3 characters </small>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="password" id="pass_word" class="form-control" placeholder="Password" name="password">
                                        <small id="pass_word_error" class="form-text text-muted">Should be minimum of 6 characters and atleast 1 alphanumeric</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="password" id="repass_word" class="form-control" placeholder="Re-Enter Password" name="password_again">
                                        <small id="repass_word_error" class="form-text text-muted">Password don't match</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email"  id="email" class="form-control" placeholder="Email" name="email">
                                    <small id="email_error" class="form-text text-muted">Enter a valid email(123@example.com)</small>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="da_y" class="form-control" name="day">
                                                <option value="" selected disabled">Select Day</option>
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                            <small id="day_error" class="form-text text-muted">Please Select a day</small>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="mon_th" class="form-control" name="month">
                                                <option value="" selected disabled">Select Month</option>
                                                <option value="1">January</option>
                                                <option value="2">Febuary</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <small id="month_error" class="form-text text-muted">Please Select a month</small>
                                        </div>
                                        
                                    
                                <div class="col-md-4">
                               
                                     <input type="year" id="year" class="form-control" placeholder="Year" name="year">
                                     <small id="year_error" class="form-text text-muted">Must be numeric and 4 characters long</small>
                                     
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="coun_try" name="country">
                                        <option value="" selected disabled">Select Country</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AX">Aland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua &amp; Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AC">Ascension Island</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia &amp; Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="IC">Canary Islands</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="BQ">Caribbean Netherlands</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="EA">Ceuta &amp; Melilla</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CP">Clipperton Island</option>
                                        <option value="CC">Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CD">Congo (DRC)</option>
                                        <option value="CG">Congo (Republic)</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DG">Diego Garcia</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard &amp; McDonald Islands</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="XK">Kosovo</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="KP">North Korea</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestine</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn Islands</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Réunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SX">Sint Maarten</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia &amp; South Sandwich Islands</option>
                                        <option value="KR">South Korea</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="BL">St. Barthélemy</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="KN">St. Kitts &amp; Nevis</option>
                                        <option value="LC">St. Lucia</option>
                                        <option value="MF">St. Martin</option>
                                        <option value="PM">St. Pierre &amp; Miquelon</option>
                                        <option value="VC">St. Vincent &amp; Grenadines</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard &amp; Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syria</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad &amp; Tobago</option>
                                        <option value="TA">Tristan da Cunha</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks &amp; Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UM">U.S. Outlying Islands</option>
                                        <option value="VI">U.S. Virgin Islands</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican City</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="WF">Wallis &amp; Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                    <small id="coun_try_error" class="form-text text-muted">Please Select a country</small>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="token" value="<?=$data['token']?>">
                                    <button type="submit" id="register" class="btn btn-success  pull-xs-right">Register</button>
                                </div>
                            </form>
                        </div>
                         
                         
                         
                         
                         </div>
                         </div>
                         </div>
                         </div>
                         </div>
                         </div>
                         
                         <script type="text/javascript" src="/public/js/jquery-2.2.1.min.js">
</script>
<script>
$(document).ready(function(){
			$("#user_name_error").hide();
			$("#first_name_error").hide();
			$("#pass_word_error").hide();
			$("#email_error").hide();
			$("#repass_word_error").hide();
			$("#last_name_error").hide();
			$("#coun_try_error").hide();
			$("#month_error").hide();
			$("#day_error").hide();
					$("#year_error").hide();
			
			
			
			
			
			$("#user_name").focusout(function(){
				check_username();		});
				
				$("#first_name").focusout(function(){
				check_firstname();		});
				
				$("#pass_word").focusout(function(){
				check_password();		});
				$("#email").focusout(function(){
				check_email();		});
				$("#repass_word").focusout(function(){
				check_repassword();		});
					$("#last_name").focusout(function(){
				check_lastname();		});
					$("#coun_try").focusout(function(){
				check_country();		});
				$("#mon_th").focusout(function(){
				check_month();		});
				$("#da_y").focusout(function(){
				check_day();		});
				$("#year").focusout(function(){
				check_year();		});
				
				
				
				
						
			
			
			
			function check_username(){
				var username_length=$("#user_name").val().length;
				if(username_length < 3){
				
					$("#user_name_error").show();
					user_name_msg=true;}
					
					else{
						$("#user_name_error").hide();}}
						
		
				
			function check_firstname(){
				var firstname_length=$("#first_name").val().length;
				if(firstname_length < 3){
			
					$("#first_name_error").show();
				}
					else{
						$("#first_name_error").hide();}}
						
						function check_lastname(){
				var lastname_length=$("#last_name").val().length;
				if(lastname_length < 3){
				
					$("#last_name_error").show();
					;}
					else{
						$("#last_name_error").hide();}}
			
			function check_password(){
				var password_length=$("#pass_word").val().length;
				var password_text=$("#pass_word").val();
				var alpha = (/[a-zA-Z]/);
				var numeric=(/[0-9]/);
				 
				
			
if(password_length<6 || !alpha.test(password_text) || !numeric.test(password_text)){
						$("#pass_word_error").html("Should be minimum of 6 characters and atleast 1 alphanumeric");
					$("#pass_word_error").show();
					}
					else{
					$("#pass_word_error").hide();
						}};
						
						function check_year(){
							var year_length=$("#year").val().length;
							var year_text=$("#year").val();
							var numeric=(/[0-9]/);
							if(year_length<4 || !numeric.test(year_text)){
								$("#year_error").show();}
								else{
									$("#year_error").hide();}}
									
						
						
						
						function check_country(){
				var country=$("#coun_try").val();
				
				if(country==""){
				
					$("#coun_try_error").show();
					}
					else{
						$("#coun_try_error").hide();}}
						
						function check_month(){
				var month=$("#mon_th").val();
				if(month==""){
				$("#month_error").show();}
				else{
					$("#month_error").hide()}};
					
						
						function check_day(){
							
				var day=$("#da_y").val();
				if(day==""){
				
					$("#day_error").show();
					}
					else{
						$("#day_error").hide();}}
						
						
						
						
						function check_email(){
							var pattern=new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
							if(pattern.test($("#email").val())){
							$("#email_error").hide();
							}else{
								
								$("#email_error").show();
								}}
								
								function check_repassword(){
									var password=$("#pass_word").val();
									var retype_password=$("#repass_word").val();
									if(retype_password==""){
										$("#repass_word_error").html("Cannot be empty");
										$("#repass_word_error").show();}
									else if(password != retype_password){
										$("#repass_word_error").html("Password doesn't match");
										$("#repass_word_error").show();
										}
										else{
											$("#repass_word_error").hide();}}
											
											
											
											
											
								
					
				
				
				
				});
				
				
				
				
			
						
						
					
			
			
			
			
			
			
			
			</script>


</body>

</html>
