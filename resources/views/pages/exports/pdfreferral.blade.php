<div class="pdf-canvas">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <div>
                    DATE: 
                    <?php
                    date_default_timezone_set('Asia/Singapore');
                    echo date('Y-m-d');
                    ?>                    
                </div> --}}
                <div>
                    <p style="text-align: center;"><span style="font-size: 20px;"><strong>RURAL HEALTH CENTER<br></strong></span><span style="font-size: 18px;">Municipality of Laur<br>Nueva Ecija, Philippines 3129</span><br><span style="font-size: 13px;">Tel. No: (XXX) XXX-XXXX<br>E-mail: <a href="mailto:email@gmail.com">email@gmail.com</a></span></p>
                    <hr/>
                    <p style="text-align: center;"><br><br></p>
                    <p style="text-align: center;"><span style="font-size: 26px;"><strong>REFERRAL LETTER</strong></span></p>                    
                    <p style="text-align: center;"><br></p>
                    <p style="text-align: right; ">Date: 
                        <span>
                            <u>
                            <?php
                            date_default_timezone_set('Asia/Singapore');
                            echo date('Y-m-d');
                            ?> 
                            </u>  
                        </span>
                    </p>
                    <p>Patient: <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->sessiontoappointment->patientowner->patient_fname) }} {{ strtoupper($data->sessiontoappointment->patientowner->patient_lname) }}</span>, <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->sessiontoappointment->patientowner->patient_birthday) }}</span></p>
                    <p style="text-align: justify;">Sir/Ma&apos;am:</p>
                    <p>We are writing to refer the above-mentioned patient, <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->sessiontoappointment->patientowner->patient_fname) }} {{ strtoupper($data->sessiontoappointment->patientowner->patient_lname) }}</span>, for further evaluation and management at your facility.</p>
                    <p>The patient was examined in our facility on <span style="text-decoration: underline; font-weight:bold">{{ strtoupper(date("F j, Y", strtotime($data->sessiontoappointment->appointment_datetime)))}}</span> due to <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_complaint) }}</span>. After a thorough examination and based on the available resources at our rural health clinic, we believe the patient would benefit from the expertise and advanced resources available at your facility.</p>
                    <p style="text-align: center;"><br></p>
                    <p>Complaint: <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_complaint) }}</span></p>
                    <p>Impression: <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_findings) }}</span></p>
                    <p>Treatment: <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_treatment) }}</span></p>
                    
                    <p style="text-align: justify;"><br></p>
                    <p>Thank you for your time and consideration.</p>

                    <p style="text-align: justify;"><br><br></p>
                    <p style="text-align: right; "><span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->sessiontoappointment->patientowner->hcworker->fname) }} {{ strtoupper($data->sessiontoappointment->patientowner->hcworker->lname)}}, M.D.</span><br><span>Physician&apos;s Name &amp; Signature<br>License No.</span><span style="text-decoration: underline; white-space: pre;">                             </span></p>
                    {{-- <p style="text-align: right;">Physician&apos;s Name &amp; Signature<br>License No. &lt;LICENSE NO&gt;</p> --}}
                    <p style="text-align: left;">Not valid without the<br>official RHC seal/stamp.</p>
                </div>
                
            </div>
        </div>
    </div>
</div>