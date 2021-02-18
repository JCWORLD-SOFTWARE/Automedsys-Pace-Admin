<!-- BEGIN PROFILE CONTENT -->

								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase"><?=$result["AccountNumber"]?> Profile</span>
										</div>
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
											</li>
										
											<li>
												<a href="#tab_1_3" data-toggle="tab">Address</a>
											</li>
										
										</ul>
									</div>
									<div class="portlet-body">
										<div class="tab-content">
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active" id="tab_1_1">
												
													<div class="form-group">
														<label class="control-label">First Name</label>
														<input type="text" placeholder="<?=$result["Name"]["FirstName"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">Last Name</label>
														<input type="text" placeholder="<?=$result["Name"]["LastName"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">Mobile Number</label>
														<input type="text" placeholder="PROVIDE EXAMPLE" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">Account No</label>
														<input type="text" placeholder="<?=$result["AccountNumber"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">Occupation</label>
														<input type="text" placeholder="NO OCCUPATION ON PROFILE" class="form-control"/>
													</div>
												
													
												
											</div>
											<!-- END PERSONAL INFO TAB -->
						
											<!-- CHANGE PASSWORD TAB -->
											<div class="tab-pane" id="tab_1_3">
													
													<div class="form-group">
														<label class="control-label">Address Line 1</label>
														<input type="text" placeholder="<?=$result["Address"]["AddressLine1"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">Address Line 2</label>
														<input type="text" placeholder="<?=$result["Address"]["AddressLine2"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">City</label>
														<input type="text" placeholder="<?=$result["Address"]["City"]?>" class="form-control" readonly />
													</div>
												
													<div class="form-group">
														<label class="control-label">Zip Code</label>
														<input type="text" placeholder="<?=$result["Address"]["ZipCode"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">State</label>
														<input type="text" placeholder="<?=$result["Address"]["State"]?>" class="form-control" readonly />
													</div>
													<div class="form-group">
														<label class="control-label">Country</label>
														<input type="text" placeholder="<?=$result["Address"]["Country"]?>" class="form-control" readonly />
													</div>
													
												
											</div>
											<!-- END CHANGE PASSWORD TAB -->
						
										</div>
									</div>
								</div>
							
					<!-- END PROFILE CONTENT -->
