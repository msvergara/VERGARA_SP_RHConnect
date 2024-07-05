<div class="pdf-canvas">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p style="text-align: center;"><span style="font-size: 20px;"><strong>RURAL HEALTH CENTER<br></strong></span><span style="font-size: 18px;">Municipality of Laur<br>Nueva Ecija, Philippines 3129</span><br><span style="font-size: 13px;">Tel. No: (XXX) XXX-XXXX<br>E-mail: <a href="mailto:email@gmail.com">email@gmail.com</a></span></p>
                    <hr/>
                    <p style="text-align: center;"><br><br></p>
                    <p style="text-align: center;"><span style="font-size: 26px;"><strong>MEDICAL CERTIFICATE</strong></span></p>                    
                    <p style="text-align: center;"><br></p>
                    <p style="text-align: justify; ">DATE: 
                        <span>
                            <u>
                            <?php
                            date_default_timezone_set('Asia/Singapore');
                            echo date('Y-m-d');
                            ?> 
                            </u>  
                        </span>
                    </p>
                    <p style="text-align: justify;">This is to certify that <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->sessiontoappointment->patientowner->patient_fname) }} {{ strtoupper($data->sessiontoappointment->patientowner->patient_lname) }}</span> was seen and examined in this health center on <span style="text-decoration: underline; font-weight:bold">{{ strtoupper(date("F j, Y", strtotime($data->sessiontoappointment->appointment_datetime)))}}</span> due to <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_complaint) }}</span> and was given the following impression: <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_findings) }}</span>.</p>
                    {{-- <p style="text-align: justify;">The above patient was advised to rest from &lt;DATE&gt; up to &lt;DATE&gt; barring any complications.</p> --}}
                    <p style="text-align: justify;">Treatment Done: <span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->session_treatment) }}</span></p>
                    <p style="text-align: justify;"><br></p>
                    <p style="text-align: right; "><span style="text-decoration: underline; font-weight:bold">{{ strtoupper($data->sessiontoappointment->patientowner->hcworker->fname) }} {{ strtoupper($data->sessiontoappointment->patientowner->hcworker->lname)}}, M.D.</span><br><span>Physician&apos;s Name &amp; Signature<br>License No.</span><span style="text-decoration: underline; white-space: pre;">                             </span></p>
                    {{-- <p style="text-align: right;">Physician&apos;s Name &amp; Signature<br>License No. &lt;LICENSE NO&gt;</p> --}}
                    <p style="text-align: left;">Not valid without the<br>official RHC seal/stamp.</p>
                </div>
                
            </div>
        </div>
    </div>
</div>