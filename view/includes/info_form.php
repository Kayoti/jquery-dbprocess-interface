<div class="row">
	<div class="col-lg-12">
		<div id="form-content" class="modal fade in" style="display: none; padding-left: 0px !important;">
				<div class="modal-header">
					<h3>Review Client</h3>
				</div>
								
				<div class="modal-body">
					<form id="info_form" class="contact" name="info_form">
					
				<!-- BANKING -->
						
					
					<div class="row">
						<div class="col-lg-8">
							<div class="form_box_wrap">
							<div class="clearfix"></div>
							<input id="tag" type="hidden" name="tag" class="input-xlarge" />
								<div class="row form_box">
									
									<h4 class="modal-subheading">Banking</h4>
									
									<div class="col-lg-4">
										<label class="label" for="emt">EMT</label>
										
										<input id="emt" type="text" name="emt" class="input-xlarge" />
									</div>
									<div class="col-lg-4">
										<label class="label" for="emt">EMT Password</label>
								<input id="emt_pass" type="text" name="emt_pass" class="input-xlarge" />
									</div>
									
								</div>
								
							</div>
						</div>
						
						<div class="col-lg-4">
							<div class="form_box_wrap">
								
								<div class="form_box">
									<input id="emt_checkbox" type="checkbox"  data-width="100" data-height="50" unchecked data-toggle="toggle" data-on="READY" data-off="PENDING" data-onstyle="success" data-offstyle="warning">
									<select id="audit_emt" name="audit_emt"></select>
								</div>
								
							</div>
						</div>
						
					</div>			
					
				<!-- INFO -->
					
					<div class="row">
						<div class="col-lg-8">
							<div class="form_box_wrap">
							
								<div class="row form_box">
									<h4 class="modal-subheading">Information</h4>
								
									<!--Personal-->
									<div class="col-lg-4">
										<label class="label" for="firstname">First Name</label>
										<input type="text" id="firstname" name="firstname" class="input-xlarge"/>
										
										<label class="label" for="lastname">Last Name</label>
										<input type="text" id="lastname" name="lastname" class="input-xlarge"/>
										
										<label class="label" for="email">Email</label>
										<input type="text" id="email" name="email" class="input-xlarge"/>
										
										<label class="label" for="phone">Phone</label>
										<input type="phone" id="phone" name="phone" class="input-xlarge"/>
										
										<label class="label" for="hphone">Home Phone</label>
										<input type="phone" id="hphone" name="hphone" class="input-xlarge"/>
										
										<label class="label" for="MMN">Mothers Maiden Name </label>
										<input id="mmn" name="MotherInfo"  type="text" maxlength="255" value="" class="input-xlarge" />
										
										<label class="label" for="secret">Password Code</label>
										<input id="secret" name="secret" type="text" maxlength="255" value="" class="input-xlarge"/>
															
										<label class="label" for="label:Occupation">Occupation </label>
										<input id="occupation" name="occupation"  type="text" maxlength="255" class="input-xlarge"/>
															
										<label class="label" for="Gender">Gender </label>
										<select id="gender" name="gender" class="input-xlarge">
											<option value="M" >Male</option>
											<option value="F" >Female</option>
										</select>
										
										<label class="label" for="Date_of_Birth">Date of Birth (YYYY/MM/DD)</label>
										<input name="dob" id="DOB" type="text" class="input-xlarge" required />
										
										<label class="label" for="agents">Agent</label>
										<input name="agent" id="agent" type="text" class="input-xlarge"  />
									</div>
									
								
									<div class="col-lg-4">
										<label class="label" for="lane">Address Line 1: </label>
										<input id="lane" name="lane" type="text" maxlength="255" value="" class="input-xlarge" required />
										<label class="label" for="laneTwo">Address Line 2: </label>
										<input id="laneTwo" name="laneTwo" type="text" maxlength="255" class="input-xlarge" />
										
										<label class="label" for="city">City: </label>
										<input id="city" name="city" type="text" maxlength="255" value="" class="input-xlarge" required />
										<label class="label" for="label:Province">Province: </label>                         							
										<select id="province" name="province" class="input-xlarge" required> 
											<option value="AB" >Alberta</option>
											<option value="BC" >British Columbia</option>
											<option value="SK" >Saskatchewan</option>
											<option value="MB" >Manitoba</option>
											<option value="ON" >Ontario</option>
											<option value="QU" >Quebec</option>
											<option value="NB" >New Brunswick</option>
											<option value="PE" >PEI</option>
											<option value="NS" >Nova Scotia</option>
											<option value="NL" >Newfoundland and Labrador</option>
											<option value="YT" >Yukon</option>
											<option value="NT" >Northwest Territories</option>
											<option value="NU" >Nunavut</option>
										</select>
															
										<label class="label" for="code">Postal Code</label>
										<input id="code" name="code"  type="text" maxlength="255" class="input-xlarge" value="" />
									</div>
									
								
									<div class="col-lg-4">
										<label class="label" for="">Primary ID Type </label>
										<select id="pid_type" class="input-xlarge" name="PrimaryIDType">
											<option value="1" >Drivers License</option>
											<option value="2" >Passport</option>
											<option value="3" >Certificate Canadian Citizenship</option>
											<option value="4" >Canadian Permanent Residence Card</option>
											<option value="5" >Secure Certificate Of Indian Status</option>
											<option value="6" >Certificate of Naturalization</option>
											<option value="7" >Birth Certificate</option>
											<option value="8" >Social Insurance Card</option>
											<option value="9" >Canada Old Age Security Card</option>
											<option value="11" >Canada Aboriginal Status Card</option>
											<option value="14" >Health Card</option>
											<option value="21" >Visa Permit</option>
											<option value="30" >Alberta ID</option>
											<option value="31" >Manitoba ID</option>
											<option value="32" >Saskatchewan ID</option>
											<option value="33" >BCID Cards</option>
											<option value="34" >Service New Brunswick Cards</option>
											<option value="35" >Nova Scotia ID</option>
											<option value="36" >PE ID</option>
											<option value="37" >NF and Labrador ID</option>
											<option value="38" >NWT ID</option>
											<option value="39" >PAL - Possession and Acquisition License</option>
											<option value="40" >FAC - Firearms Acquisition Certificates</option>
											<option value="42" >NDI20 - National Defence Canadian Forces Identification Card</option>
											<option value="45" >Nunavut ID</option>
											<option value="46" >Ontario ID</option>
											<option value="47" >Yukon ID</option>
											<option value="51" >BC Services Card ID</option>
											<option value="52" >BC ID</option>
										</select>
															
										<label class="label" for="id_number">ID Number </label>
										<input id="pid_num" name="PrimaryIDNumber" type="text" maxlength="255"  value="" class="input-xlarge"/>
	
										<label class="label" for="id_place">Place of Issuance</label>
										<select id="pid_place" name="PrimaryPlaceOfIssue" class="input-xlarge" required> 
											<option value="AB" >Alberta</option>
											<option value="BC" >British Columbia</option>
											<option value="SK" >Saskatchewan</option>
											<option value="MB" >Manitoba</option>
											<option value="ON" >Ontario</option>
											<option value="QU" >Quebec</option>
											<option value="NB" >New Brunswick</option>
											<option value="PE" >PEI</option>
											<option value="NS" >Nova Scotia</option>
											<option value="NL" >Newfoundland and Labrador</option>
											<option value="YT" >Yukon</option>
											<option value="NT" >Northwest Territories</option>
											<option value="NU" >Nunavut</option>
										</select>
	
										<label class="label" for="PrimaryIDExpiryDate">Expiry Date (YYYY/MM/DD)</label>
										<input id="pid_expire" name="PrimaryIDExpiryDate" data-format="yyyy-mm-dd" type="text" class="input-xlarge" required />
										<label class="label" for="SecondaryIDType">Secondary ID Type </label>
										<select id="sid_type" name="SecondaryIDType">
											<option value="1" >Drivers License</option>
											<option value="2" >Passport</option>
											<option value="3" >Certificate Canadian Citizenship</option>
											<option value="4" >Canadian Permanent Residence Card</option>
											<option value="5" >Secure Certificate Of Indian Status</option>
											<option value="6" >Certificate of Naturalization</option>
											<option value="7" >Birth Certificate</option>
											<option value="8" >Social Insurance Card</option>
											<option value="9" >Canada Old Age Security Card</option>
											<option value="11" >Canada Aboriginal Status Card</option>
											<option value="14" >Health Card</option>
											<option value="16" >Automated Banking Card (ABM)</option>
											<option value="17" >Credit Card</option>
											<option value="18" >CNIB Client Card</option>
											<option value="21" >Visa Permit</option>
											<option value="30" >Alberta ID</option>
											<option value="32" >Saskatchewan ID</option>
											<option value="33" >BCID Cards</option>
											<option value="34" >Service New Brunswick Cards</option>
											<option value="35" >Nova Scotia ID</option>
											<option value="36" >PE ID</option>
											<option value="37" >NF and Labrador ID</option>
											<option value="38" >NWT ID</option>
											<option value="39" >PAL - Possession and Acquisition License</option>
											<option value="40" >FAC - Firearms Acquisition Certificates</option>
											<option value="41" >GSP - Government Security Policy Employee ID Cards</option>
											<option value="42" >NDI20 - National Defence Canadian Forces Identification Card</option>
											<option value="43" >BYID Card - Bring Your ID, Ontario Liquor License</option>
											<option value="44" >CSC - Correctional Services Canada ID Cards</option>
											<option value="45" >Nunavut ID</option>
											<option value="46" >Ontario ID</option>
											<option value="47" >Yukon ID</option>
											<option value="51" >BC Services Card ID</option>
											<option value="52" >BC ID</option>
										</select>
																
										<label class="label" for="id_number">ID Number </label>
										<input id="sid_num" name="SecondaryIDNumber" type="text" maxlength="255"  value="" class="input-xlarge"/>
	
										<label class="label" for="id_place">Place of Issuance</label>
										<select id="sid_place" name="SecondaryPlaceOfIssue" class="input-xlarge" required> 
											<option value="AB" >Alberta</option>
											<option value="BC" >British Columbia</option>
											<option value="SK" >Saskatchewan</option>
											<option value="MB" >Manitoba</option>
											<option value="ON" >Ontario</option>
											<option value="QU" >Quebec</option>
											<option value="NB" >New Brunswick</option>
											<option value="PE" >PEI</option>
											<option value="NS" >Nova Scotia</option>
											<option value="NL" >Newfoundland and Labrador</option>
											<option value="YT" >Yukon</option>
											<option value="NT" >Northwest Territories</option>
											<option value="NU" >Nunavut</option>
										</select>
														
										<label class="label" for="SecondaryIDExpiryDate">Expiry Date (YYYY/MM/DD)</label>
										<input id="sid_expire" name="SecondaryIDExpiryDate" data-format="yyyy-mm-dd" type="text" required class="input-xlarge" />
									</div>
								</div>
							</div>
						</div>
							
							<div class="col-lg-4">
								<div class="form_box_wrap">
								
									<div class="form_box">
										<input id="info_checkbox" type="checkbox"  data-width="100" data-height="50"  data-toggle="toggle" data-on="READY" data-off="PENDING" data-onstyle="success"  data-offstyle="warning">
										<select id="audit_info" name="audit_info">
											<option title="" value="0" selected>--INFO STATUS--</option>
										</select>
									</div>
							
								</div>
							</div>
						</div>				

				<!-- CONTRACT-->	
					
					<!--<div class="row">
					
						<div class="col-lg-8">
							<div class="form_box_wrap">
							
								<div class="row form_box">
									<h4 class="modal-subheading">Contract</h4>
									<div class="col-lg-4">
										<input id="" type="text" name="" class="input-xlarge" disabled/>
									</div>
									<div class="col-lg-4">
										<input id="" type="text" name="" class="input-xlarge" disabled/>
									</div>
									<div class="col-lg-4">
										<input id="" type="text" name="" class="input-xlarge" disabled/>
									</div>
								</div>
								
							</div>
						</div>
							
						<div class="col-lg-4">
							<div class="form_box_wrap">
								<div class="form_box">
									<input id="contract_checkbox" type="checkbox"  data-width="100" data-height="50" unchecked data-toggle="toggle" data-on="READY" data-off="PENDING" data-onstyle="success" data-offstyle="warning">
									<select id="audit_contract" name="audit_contract">
									 	<option title="" value="0">--CONTRACT STATUS--</option>
									</select>
								</div>	
							</div>	
						</div>
							
					</div>-->
						
					</form>
						
						<div class="modal-footer">
							<input class="submit_info btn btn-success" type="submit" value="UPDATE" id="submit">
							<a href="#" class="exit btn btn-primary" data-dismiss="modal">Exit</a>
							<a href="#" class="lockedbtn" data-dismiss="modal" style="display:none;"></a>
						</div>
						
					</div>
				
		</div>	
	</div>
</div>