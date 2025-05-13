<?php include('header.php');?>
<?php
	date_default_timezone_set('Europe/London');
	$current_date =  date('d-m-Y'); // Example output: 16-04-2025
?>
<style>
    thead.thead-dark-blue th {
        background-color: #14264d;
        color: #fff;
        border-color: #14264d;
        padding: 8px 15px;
            text-wrap-mode: nowrap;
    }
    tbody tr td{
    }
    input[type=checkbox], input[type=radio] {
        height: 15px!important;
        width: 15px;
    }
    .table .form-control {
        height: 30px;
        line-height: 30px;
    }
    #p-15 {
        margin: 0px;
        padding: 15px 0px;
    }
    footer {
        background: #ffffff;
        margin-top: 50px;
    }
    .section-header2{
        color: #14264d;
        padding: 10px 20px;
        font-weight: bold;
        font-size: 20px;
    }
    h5.table_middle_heading {
        color: #f55e1d;
        font-size: 18px;
        font-weight: 600;
    }
    #other_show{
        margin-top: 60px;
    }

	.toast-msg {
  display: none;
  position: fixed;
  top: 20px;
  right: -300px;
  background-color: #28a745;
  color: white;
  padding: 15px 25px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0,0,0,0.3);
  z-index: 9999;
  font-size: 16px;
  transition: right 0.5s ease-in-out;
}
.toast-msg.show {
  display: block;
  right: 20px;
}

.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid purple;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 0.8s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



</style>

<?php include('navigation.php');?>
<div class="page-content">
  <!-- Breadcrumb -->
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add New Job </li>
    </ol>
  </div>
   <!-- Dashboard Header -->
   <div id="toast" class="toast-msg">Form submitted successfully!</div>
	<?php //echo $this->uri->uri_string(); die("asdfasdf"); ?>
   <?= form_open_multipart($this->uri->uri_string(), ['class' => 'client-form', 'autocomplete' => 'off','id'=>'jobForm']); ?>
		<div class="container">
			<div class="dashboard-tab-wrapper mb-3">
			<div class="dashboard-tab">NEW JOB</div>
			<div class="dashboard-line"></div>
			</div>
			<div class="row mt-3 bg-white" id="p-15">
			<!-- Completed Jobs -->
				<div class="col-md-5 bg-white">
					<div class="section-header2">New Job Details</div>
				<div class="box">
					<div class="form-group">
						<label>Assignment Type <span>*</span></label>
						<select class="form-control" placeholder="Job Code" id="job_code" name="assignment_type">
							<option value="">Select Type of Assignment</option>
							<option value="year_end_account">Year End Account</option>
							<option value="bookkeeping">Bookkeeping / VAT</option>
							<option value="personal_tax_return">Personal Tax Return</option>
							<option value="other">Other</option>
						</select>
						<span class="error-msg"></span>
					</div>
					<div class="form-group">
						<label>Name of Client <span>*</span></label>
						<input type="text" class="form-control" name="client_name">
						<span class="error-msg"></span>
					</div>
					<div class="form-group">
						<label>Contact Name <span>*</span></label>
						<input type="text" class="form-control" name="contact_person">
						<span class="error-msg"></span>
					</div>
					<div class="form-group">
						<label>Email Address <span>*</span></label>
						<input type="text" class="form-control" name="email_address" 
						oninvalid="this.setCustomValidity('Please enter email in correct format')"
						oninput="this.setCustomValidity('')">
						<span class="error-msg"></span>
					</div>
					<div class="form-group" id="div_tax_year">
						<label>Tax Year <span>*</span></label>
						<select class="form-control" name="tax_year_end">
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
						</select>
						<span class="error-msg"></span>
					</div>
					<div class="form-group" name="div_year_end" id="div_year_end" style="display:none">
						<label>Year End <span>*</span></label>
						<input type="date" class="form-control" name="year_end" id="year_end" placeholder="dd/mm/yyyy" />
					
						<span class="error-msg"></span>

					</div>

					<div class="form-group" id="bookkepping_tax_year" style="display:none">
						<label>Quarter/Period <span>*</span></label>
						<select class="form-control" name="qtr_year_end">
								<option value="January">January</option>
								<option value="February">February</option>
								<option value="March">March</option>
								<option value="April">April</option>
								<option value="May">May</option>
								<option value="June">June</option>
								<option value="July">July</option>
								<option value="August">August</option>
								<option value="September">September</option>
								<option value="October">October</option>
								<option value="November">November</option>
								<option value="December">December</option>
						</select>
						<span class="error-msg"></span>
					</div>


					<div class="form-group" id="bookkepping_tax_year_qy" style="display:none">
						<label>Year <span>*</span></label>
						<select class="form-control" name="qtr_year_end_qy">
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
							<option value="2026">2026</option>
							<option value="2027">2027</option>
							<option value="2028">2028</option>
							<option value="2029">2029</option>
							<option value="2030">2030</option>
						</select>
						<span class="error-msg"></span>
					</div>


					<div class="form-group" id="budget_year">
						<label>Budgeted Hours</label>
						<input type="text" class="form-control" name="budgeted_hours">
					</div>
					<div class="form-group" id="accountancy_fee1">
						<label>Accountancy Fee(Net) <span>*</span></label>
						<input type="text" class="form-control" name="accountancy_fee_net">
						<span class="error-msg"></span>
					</div>
					<div class="form-group">
						<label>Select Attachments <span></span></label>
						<!-- <input type="file" class="form-control" name="attachement[]"> -->
						<input type="file" class="form-control" name="attachments[]" multiple accept=".jpeg,.jpg,.png,.webp,.pdf,.doc,.docx,.xls,.xlsx">

						<span style="font-size: 13px; color: #f65d1f;">Total attachement size upto 100 MB</span>
						<br/>
						<span style="font-size: 13px; color: #f65d1f;">JPG,JPEG,PNG,XSLS,DOC,PDF,WEBP</span>

					</div>
					<div class="form-group" id="additiona_comment">
						<label>Additional Comment <span></span></label>
						<textarea class="form-control" name="additional_comment" rows="6"></textarea>
						<span class="error-msg"></span>

					</div>
					</div>
				</div>
				<div class="col-md-7 bg-white">
					<div class="table-responsive" style="display:none" id="personal_tax_return_show">
					<table class="table table-bordered">
						<thead class="thead-dark-blue">
							<th>Sr No.</th>
							<th>Description</th>
							<th>Yes</th>
							<th>Comments</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<th>Source of Income</th>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Employment</td>
								<td><input type="checkbox" name="ptr_employment_2" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_2" class="form-control">
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Pension Income</td>
								<td><input type="checkbox" name="ptr_employment_3" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_3" class="form-control">
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Self Employment</td>
								<td><input type="checkbox" name="ptr_employment_4" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_4" class="form-control">
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>UK Property</td>
								<td><input type="checkbox" name="ptr_employment_5" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_5" class="form-control">
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>Partnership</td>
								<td><input type="checkbox" name="ptr_employment_6" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_6" class="form-control">
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>Interest Income</td>
								<td><input type="checkbox" name="ptr_employment_7" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_7" class="form-control">
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td>Divided Income</td>
								<td><input type="checkbox" name="ptr_employment_8" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_8" class="form-control">
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td>Foreign Income</td>
								<td><input type="checkbox" name="ptr_employment_9" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_9" class="form-control">
								</td>
							</tr>
							<tr>
								<td>10</td>
								<td>Capital Gain</td>
								<td><input type="checkbox" name="ptr_employment_10" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_10" class="form-control">
								</td>
							</tr>
							<tr>
								<td>11</td>
								<td>Any Other Income</td>
								<td><input type="checkbox" name="ptr_employment_11" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_11" class="form-control">
								</td>
							</tr>
							<tr>
								<td>12</td>
								<td>Last Year Tax return</td>
								<td><input type="checkbox" name="ptr_employment_12" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_12" class="form-control">
								</td>
							</tr>
							<tr>
								<td>13</td>
								<td>Payment On Account</td>
								<td><input type="checkbox" name="ptr_employment_13" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_13" class="form-control">
								</td>
							</tr>
							<tr>
								<td>14</td>
								<td>Any Other Info</td>
								<td><input type="checkbox" name="ptr_employment_14" class="form-control"></td>
								<td>
									<input type="text" name="ptr_employment_text_14" class="form-control">
								</td>
							</tr>
						</tbody>
					</table>
					</div>
					<div class="table-responsive" style="display:none" id="bookkeeping_show">
						<table class="table table-bordered">
							<thead class="thead-dark-blue">
								<th>Sr No.</th>
								<th>Description</th>
								<th>Yes</th>
								<th>Comments</th>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Nature of Business</td>
									<td><input type="checkbox" name="book_employment_1" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_1" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>2</td>
									<td>VAT Scheme (Cash/Standard/Flat rate/Margin)</td>
									<td><input type="checkbox" name="book_employment_2" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_2" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>3</td>
									<td>Previous VAT Returns</td>
									<td><input type="checkbox" name="book_employment_3" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_3" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>4</td>
									<td>Bank account statements (all business accounts)</td>
									<td><input type="checkbox" name="book_employment_4" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_4" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>5</td>
									<td>Credit card statements (all business credit cards)</td>
									<td><input type="checkbox" name="book_employment_5" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_5" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>6</td>
									<td>HP/Loan statements (if applicable)</td>
									<td><input type="checkbox" name="book_employment_6" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_6" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>7</td>
									<td>Accounting software (Sage, QuickBooks, Xero)</td>
									<td><input type="checkbox" name="book_employment_7" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_7" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>8</td>
									<td>Copies of sales invoices issued</td>
									<td><input type="checkbox" name="book_employment_8" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_8" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>9</td>
									<td>Receipts for business expenses</td>
									<td><input type="checkbox" name="book_employment_9" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_9" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>10</td>
									<td>Access to POS system reports (if applicable)</td>
									<td><input type="checkbox" name="book_employment_10" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_10" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>11</td>
									<td>Expense reimbursement details e.g., mileage logs</td>
									<td><input type="checkbox" name="book_employment_11" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_11" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>12</td>
									<td>Payroll Reports (Payroll Summary, P32 report)</td>
									<td><input type="checkbox" name="book_employment_12" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_12" class="form-control">
									</td>
								</tr>
								
								<tr>
									<td>13</td>
									<td>Cash expenses report</td>
									<td><input type="checkbox" name="book_employment_13" class="form-control"></td>
									<td>
										<input type="text" name="book_employment_text_13" class="form-control">
									</td>
								</tr>
								
							</tbody>
						</table>
					</div>
					<div class="table-responsive" style="display:none" id="other_show">
						<div class="form-group" id="additiona_comment">
							<label>Additional Comment <span>*</span></label>
							<textarea class="form-control" name="additiona_comment" rows="8"></textarea>
						</div>
					</div>
					<div class="table-responsive" style="display:none" id="year_end_account_show">
					<table class="table table-bordered">
						<thead class="thead-dark-blue">
							<th>Sr No.</th>
							<th>Description</th>
							<th>Yes</th>
							<th>Comments</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Nature of Business <span>*</span></td>
								<td><input type="checkbox" name="yea_employment_1" class="form-control"></td>
								<td><input type="text" name="yea_employment_text_1" class="form-control"></td>
							</tr>
							
							<tr>
								<td colspan="4">
									<h5 class="table_middle_heading">Records </h5>
								</td>
							</tr>
							<tr>
								<td></td>
								<th>Documents</th>
								<td></td>
								<td></td>
							</tr>
							<tr>
							<tr>
								<td>2</td>
								<td>Previous year Final account and Trial balance</td>
								<td><input type="checkbox" name="yea_employment_2" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_2" class="form-control">
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Previous year working paper</td>
								<td><input type="checkbox" name="yea_employment_3" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_3" class="form-control">
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Sales details</td>
								<td><input type="checkbox" name="yea_employment_4" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_4" class="form-control">
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Purchase / expenses details</td>
								<td><input type="checkbox" name="yea_employment_5" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_5" class="form-control">
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>Bank account statements</td>
								<td><input type="checkbox" name="yea_employment_6" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_6" class="form-control">
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>Credit card statement</td>
								<td><input type="checkbox" name="yea_employment_7" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_7" class="form-control">
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td>Loan / HP statements</td>
								<td><input type="checkbox" name="yea_employment_8" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_8" class="form-control">
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td>Payroll / CIS records</td>
								<td><input type="checkbox" name="yea_employment_9" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_9" class="form-control">
								</td>
							</tr>
							<tr>
								<td>10</td>
								<td>Expenses re-imbursement details</td>
								<td><input type="checkbox" name="yea_employment_10" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_10" class="form-control">
								</td>
							</tr>
							<tr>
								<td>11</td>
								<td>Client cashbook</td>
								<td><input type="checkbox" name="yea_employment_11" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_11" class="form-control">
								</td>
							</tr>
							<tr>
								<td>12</td>
								<td>Others</td>
								<td><input type="checkbox" name="yea_employment_12" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_12" class="form-control">
								</td>
							</tr>
							<tr>
								<td>13</td>
								<td> Any key events in the year</td>
								<td><input type="checkbox" name="yea_employment_13" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_13" class="form-control">
								</td>
							</tr>
							<tr>
								<td>14</td>
								<td> Closing stock value</td>
								<td><input type="checkbox" name="yea_employment_14" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_14" class="form-control">
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<h5 class="table_middle_heading">VAT</h5>
								</td>
							</tr>
							<tr>
								<td>15</td>
								<td>VAT Scheme</td>
								<td><input type="checkbox" name="yea_employment_15" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_15" class="form-control">
								</td>
							</tr>
							<tr>
								<td>16</td>
								<td>VAT Computation Method</td>
								<td><input type="checkbox" name="yea_employment_16" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_16" class="form-control">
								</td>
							</tr>
							<tr>
								<td>17</td>
								<td>VAT Returns and Working</td>
								<td><input type="checkbox" name="yea_employment_17" class="form-control"></td>
								<td>
									<input type="text" name="yea_employment_text_17" class="form-control">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12 text-center mb-3">
				<button type="submit" class="btn btn-purple customer-form-submiter">Preview</button>
				<button  class="btn dismiss">Close</button>
			</div>
		</div>
	<?= form_close(); ?>
	<div id="loader"></div>
</div>	

<!-- Start Preview Modal-->
<div class="modal fade" id="jobDetailModal" tabindex="-1" role="dialog" aria-labelledby="jobDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="jobDetailLabel">Preview Job Detail</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                  <th>Type of assignment:</th>
                  <td class="m_assignment">Tax return</td>
                </tr>
                <tr>
                  <th>Name of client:</th>
                  <td class="m_client"></td>
                </tr>
                <tr>
                  <th>Contact Name:</th>
                  <td class="m_person"></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td class="m_email"></td>
                </tr>

				<tr id="qtr_year_end_qy" class="L686">
                  <th>Quarter/Period:</th>
                  <td class="m_qtr_year_end_qy"></td>
                </tr>

                <tr>
                  <th id="taxyear">Year:</th>
                  <td class="m_taxyear"></td>
                </tr>

                <tr>
                  <th>Budgeted hours:</th>
                  <td class="m_budget"></td>
                </tr>
                <tr>
                  <th>Accountancy Fees (Net):</th>
                  <td class="m_fee"></td>
                </tr>
                <tr class="otherComment fldother L678">
                  <th>Additional Comments:</th>
                  <td class="m_comments"></td>
                </tr>
            </table>

			<table class="table table-bordered">
				<thead>
					<tr>
					<th>File Name</th>
					<th>Type</th>
					<th>Size</th>
					</tr>
				</thead>
				<tbody class="attachmentView">
					<tr>
						<td>My File Name 1</td>
						<td>PDF</td>
						<td>1.2 MB</td>
					</tr>
					<tr>
						<td>My File Name 2</td>
						<td>DOCX</td>
						<td>900 KB</td>
					</tr>
					<tr>
						<td>My File Name 3</td>
						<td>PNG</td>
						<td>2.5 MB</td>
					</tr>
				</tbody>
				</table>

          </div>
          <div class="col-md-6 ">
		    <table class="table table-bordered">
				<tbody class="iAddComm L714">
					<tr class="">
						<th>Additional Comments:</th>
					</tr>
                    <tr>
                        <td class="om_comments"></td>
                    </tr>
				</tbody>
			</table>
            <table class="table table-bordered">
              <tbody class="previewEmployement L722">
			    <tr>
                    <td width="50">1</td>
                    <td>Employment</td>
                    <td>Yes</td>
                    <td width="200"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pension Income</td>
                    <td>No</td>
                    <td></td>
                </tr>
			  </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-purple con_and_sub">Confirm & Submit</button>
        <button type="button" class="btn dismiss" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--EndPreview Modal-->


<?php include('footer.php');?>
<script>
    $(document).ready(function () {
		// $('.customer-form-submiter').prop('disabled', true);

        $('#job_code').on('change', function () {
				
			    $('#other_show').fadeIn();
                $('#div_tax_year').show();
                $('#bookkepping_tax_year').show();
                $('#bookkepping_tax_year_qy').show();
                $('#div_year_end').show();
				$('#qtr_year_end_qy').show();

            if ($(this).val() === 'personal_tax_return') {
                $('#personal_tax_return_show').fadeIn();
                $('#bookkepping_tax_year').hide();
                $('#bookkepping_tax_year_qy').hide();
                $('#div_tax_year').show();
                $('#additiona_comment').show();
                $('#div_year_end').hide();
				$('#qtr_year_end_qy').hide();
                
            } else {
                $('#personal_tax_return_show').fadeOut();
            }
            
            if ($(this).val() === 'year_end_account') {
                $('#year_end_account_show').fadeIn();
                $('#bookkepping_tax_year').hide();
                $('#bookkepping_tax_year_qy').hide();
                $('#div_tax_year').hide();
                $('#additiona_comment').show();
                $('#div_year_end').show();
				$('#qtr_year_end_qy').hide();
				$('#taxyear').text('Year End');
            } else {
                $('#year_end_account_show').fadeOut();
            }
            
            if ($(this).val() === 'bookkeeping') {
                $('#bookkeeping_show').fadeIn();
                $('#div_tax_year').hide();
                $('#bookkepping_tax_year').show();
                $('#bookkepping_tax_year_qy').show();
                $('#additiona_comment').show();
                $('#div_year_end').hide();
				$('#qtr_year_end_qy').show();
            } else {
                $('#bookkeeping_show').fadeOut();
            }
            
            if ($(this).val() === 'other') {
                $('#other_show').fadeIn();
                $('#div_tax_year').hide();
                $('#bookkepping_tax_year').show();
                $('#bookkepping_tax_year').show();
                $('#additiona_comment').hide();
                $('#div_year_end').hide();
				$('#qtr_year_end_qy').show();
            } else {
                $('#other_show').fadeOut();
            }
        });
    });
   
</script> 


<script>
	const checklistData = <?= json_encode(
				array_reduce(
				getAllChecklists(),
				function($carry, $item) {
					$carry[$item['assignment_type']][] = [
					'id'    => $item['id'],
					'title' => $item['title'],
					'sn' => $item['sn']
					];
					return $carry;
				},
				[]
				)
			) ?>;
			console.log(checklistData,"dfff");

	function validateRequiredField(selector, message) {
		$(selector).on('blur', function () {
			const $this = $(this);
			if ($this.val().trim() === "") {
				$this.css("border", "1px solid red");
				$this.closest('div').find('.error-msg').html(message).css("color", "red").show();
			} else {
				$this.css("border", "");
				$this.closest('div').find('.error-msg').html("").hide();
			}
		});
	}

	function showToast(message) {
		$('#toast').text(message).addClass('show');

		setTimeout(function () {
			$('#toast').removeClass('show');
		}, 3000); // Hide after 3 seconds
	}

        $(document).ready(function(){
            $("#jobForm").submit(function(e){
                e.preventDefault(); 
				
				 let isValid = true;
    			 let errorMsg = "";	
				 $('span.error-msg').html('').hide();

				var formData = new FormData(this);
				// Loop through all fields and files
				

   			    validateRequiredField('[name="client_name"]', "Client name is required");
				validateRequiredField('[name="assignment_type"]', "Please select assignment type");
				validateRequiredField('[name="email_address"]', "Email is required");
				validateRequiredField('[name="qtr_year_end"]', "Please select quarter year end");
				validateRequiredField('[name="accountancy_fee_net"]', "Accountancy fee is required");

				if ($('[name="assignment_type"]').val().trim() === "") {
					isValid = false;
					$('[name="assignment_type"]').css("border", "1px solid red");
					$('[name="assignment_type"]').closest('div').find('.error-msg').html("Please select assignment type").css("color", "red").show();
				} else {
					$('[name="assignment_type"]').css("border", "");
					$('[name="assignment_type"]').closest('div').find('.error-msg').html("").hide();
				}

				if ($('[name="client_name"]').val().trim() === "") {
					isValid = false;
					$('[name="client_name"]').css("border", "1px solid red");
					$('[name="client_name"]').closest('div').find('.error-msg').html("Client name is required").css("color", "red").show();
				} else {
					$('[name="client_name"]').css("border", "");
					$('[name="client_name"]').closest('div').find('.error-msg').html("").hide();
				}

				// Contact Person validation
				if ($('[name="contact_person"]').val().trim() === "") {
					isValid = false;
					$('[name="contact_person"]').css("border", "1px solid red");
					$('[name="contact_person"]').closest('div').find('.error-msg').html("Contact Name is required").css("color", "red").show();
				} else {
					$('[name="contact_person"]').css("border", "");
					$('[name="contact_person"]').closest('div').find('.error-msg').html("").hide();
				}

				if ($('[name="assignment_type"]').val().trim() == "year_end_account") {
					// year_end validation
					var date = $('#year_end').val().trim();
					if (date === "") {
						isValid = false;
						// $('#year_end').css("border", "1px solid red");
						$('#year_end').closest('div').find('.error-msg')
							.html("Date is required")
							.css("color", "red")
							.show();
					} else {
						$('#year_end').css("border", "");
						$('#year_end').closest('div').find('.error-msg').hide();
					}
				}

				// Email validation
				var email = $('[name="email_address"]').val().trim();
				var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email pattern
				if (email === "") {
					isValid = false;
					$('[name="email_address"]').css("border", "1px solid red");
					$('[name="email_address"]').closest('div').find('.error-msg')
						.html("Email is required")
						.css("color", "red")
						.show();
				} else if (!emailRegex.test(email)) {
					isValid = false;
					$('[name="email_address"]').css("border", "1px solid red");
					$('[name="email_address"]').closest('div').find('.error-msg')
						.html("Please enter a valid email address")
						.css("color", "red")
						.show();
				} else {
					$('[name="email_address"]').css("border", "");
					$('[name="email_address"]').closest('div').find('.error-msg').hide();
				}

				// Accountancy Fee validation
				if ($('[name="assignment_type"]').val().trim() != "other") {
					if ($('[name="accountancy_fee_net"]').val().trim() === "") {
						isValid = false;
						$('[name="accountancy_fee_net"]').css("border", "1px solid red");
						$('[name="accountancy_fee_net"]').closest('div').find('.error-msg').html("Accountancy fee is required").css("color", "red").show();
						// alert("accountancy_fee_net required");
					} else {
						$('[name="accountancy_fee_net"]').css("border", "");
						$('[name="accountancy_fee_net"]').closest('div').find('.error-msg').html("").hide();
					}
				}

				if (!isValid) {
					return;
				}
				$("#loader").show();
				$("#responseMsg").hide();
				showPreviewAndBind(formData);
            });
        });

		function showPreviewAndBind(formData) {
			// Show your preview modal
			showPreviewModal(formData);

			// Unbind any previous handlers, then bind a one-time click
			$('.con_and_sub').off('click').one('click', function() {
				// Grab the form data fresh (if you need it again)
				var formData = new FormData($('#jobForm')[0]);
				// Fire off your AJAX
				submitNewJob(formData);
			});
		}

		function showPreviewModal(formData) {
			for (let [key, value] of formData.entries()) {
				console.log(key, ":", value);
			}
			const assignment = formData.get('assignment_type')      || '';
			const client     = formData.get('client_name')          || '';
			const person     = formData.get('contact_person')       || '';
			const email      = formData.get('email_address')        || '';
			const taxYearEnd = formData.get('tax_year_end')         || '';
			const yearEnd    = formData.get('year_end')             || '';
			const m_budget   = formData.get('budgeted_hours')      || '';
			const m_fee      = formData.get('accountancy_fee_net')    || '';
			const qtr_year_end    = formData.get('qtr_year_end')    || '';
			const qtr_year_end_qy      = formData.get('qtr_year_end_qy')    || '';
			const m_comments = formData.get('additional_comment') || '';
			const additiona_comment = formData.get('additiona_comment') || '';
			$('.m_comments').text(m_comments);

			if(assignment=='year_end_account'){
				$('.m_taxyear').text(yearEnd);
				$('#taxyear').text('Year End:')
			}else if(assignment=='bookkeeping'){
				$('.m_taxyear').text(qtr_year_end_qy);
				$('.m_qtr_year_end_qy').text(qtr_year_end);
				$('#taxyear').text('Year:')
			}else if(assignment=='personal_tax_return'){
				$('.m_taxyear').text(taxYearEnd);
				$('#taxyear').text('Tax Year:')
			}else{
				$('.fldother').hide();
				$('.m_taxyear').text(qtr_year_end_qy);
				$('.m_qtr_year_end_qy').text(qtr_year_end);
				$('.om_comments').text(additiona_comment);
				$('#taxyear').text('Year:')
			}

			// Inject into your modal
			if (assignment === 'other') {
				$('.iAddComm').show();  //preview wala code
				// $('.fldother').hide();
				$('.qtr_year_end_qy').hide();
			}else{
				$('.iAddComm').hide();  //preview wala code
				// $('.fldother').show();
				$('.qtr_year_end_qy').show();
			}

			// Mapping object
			const assignmentTypeLabels = {
			'year_end_account':    'Year End Account',
			'bookkeeping':         'Bookkeeping / VAT',
			'personal_tax_return': 'Personal Tax Return',
			'other':               'Other'
			};

			const assignmentLabel = assignmentTypeLabels[assignment] || assignment;
			
			$('.m_assignment').text(assignmentLabel);
			$('.m_client').text(client);
			$('.m_person').text(person);
			$('.m_email').text(email);
			$('.m_email').text(email);
			$('.m_budget').text(m_budget);
			$('.m_fee').text(m_fee);
			
			const items = checklistData[assignment] || [];
			const $tbody = $('.previewEmployement');
			$tbody.empty();

			const assignmentSort = {
			'year_end_account':    'yea',
			'bookkeeping':         'book',
			'personal_tax_return': 'ptr',
			'other':               'oth'
			};

			const assignmentLabelShort = assignmentSort[assignment] || assignment;

			items.forEach((item, idx) => {
				// Assuming your form field names are:
				const textVal = formData.get(`${assignmentLabelShort}_employment_text_${item.sn}`) || '';
				const val     = formData.get(`${assignmentLabelShort}_employment_${item.sn}`)      || '';
				const finalval = val === 'on' ? 'Yes' : 'No';


				$tbody.append(`
				<tr>
					<td width="50">${idx + 1}</td>
					<td>${item.title}</td>
					<td>${finalval}</td>
					<td width="200">${textVal}</td>
				</tr>
				`);
			});

			multipleAttach(formData);

			// Finally show the modal
			$('#jobDetailModal').modal('show');
		}

		function multipleAttach(formData){
			let attachments = formData.getAll('attachments[]'); // Get all file objects
			const $tbodyattachmentView = $('.attachmentView');
			$tbodyattachmentView.empty();

			let validAttachments = attachments.filter(file => {
				// Filter out invalid or empty files
				return file instanceof File && file.size > 0 && file.name;
			});

			if (validAttachments.length === 0) {
				// No valid attachments
				$tbodyattachmentView.append(`
					<tr>
						<td colspan="3" class="text-center text-muted">No valid attachments found</td>
					</tr>
				`);
			} else {
				// Loop through valid files only
				validAttachments.forEach(file => {
					const fileName = file.name;
					const fileType = file.type || 'Unknown';
					const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

					$tbodyattachmentView.append(`
						<tr>
							<td>${fileName}</td>
							<td>${fileType}</td>
							<td>${fileSize}</td>
						</tr>
					`);
				});
			}

		}

		function multipleAttach222(formData){
			// Get attachments from FormData
			let attachments = formData.getAll('attachments[]'); // Use getAll() to get all File objects
			// alert(attachments.length);

			const $tbodyattachmentView = $('.attachmentView');
			$tbodyattachmentView.empty();

			if (attachments.length === 0) {
			// If no files selected
			$tbodyattachmentView.append(`
				<tr>
				<td colspan="3" class="text-center text-muted">No attachments found</td>
				</tr>
			`);
			} else {
			// Loop through each attachment
			attachments.forEach(file => {
				const fileName = file.name;
				const fileType = file.type || 'Unknown';
				const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB'; // Convert to MB

				$tbodyattachmentView.append(`
				<tr>
					<td>${fileName}</td>
					<td>${fileType}</td>
					<td>${fileSize}</td>
				</tr>
				`);
			});
			}
		}


		function submitNewJob(formData) {
			$('.customer-form-submiter').prop('disabled', true);
			$('#loader').show();
			$('#responseMsg').hide();

			$.ajax({
				url: "<?= base_url('Clients/ClientsAddNewJobs_POST') ?>",
				type: 'POST',
				data: formData,
				processData: false,  // required for FormData
				contentType: false,  // required for FormData
				dataType: "json",
				success: function(response){
					$('.customer-form-submiter').prop('disabled', false);
					$('#loader').hide();
					if (response.status === "success") {
					    myAjaxNotify();
						$('#jobDetailModal').modal('hide');
						showToast("✅ Thank you! Form submitted successfully.");
						$("#jobForm")[0].reset();
					} else {
						showToast("⚠️ Oops! Submission failed.");
					}
				},
				error: function(){
					$('#loader').hide();
					showToast("❌ Something went wrong. Please try again.");
				}
			});
		}

		

</script>
