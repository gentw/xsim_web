@extends('layouts.app')

@if(!empty($page_content))
    @section('content')
        {!! $page_content !!}
    @endsection
@else
    @section('banner')
    <section class="banner privacy-banner tnc-banner">
    	<div class="container">
    		<div class="desc">
                <h1>General Sales Conditions</h1>
                <p>This confidentiality policy defines the way in which EGRAPHIC DMCC uses and protects information that you give to EGRAPHIC DMCC when you use this site. EGRAPHIC DMCC is committed to make sure that your private information is protected. We ask you to provide certain information with which you can be identified during the use of this site. You can be reassured that this information will not be used in accordance with the present declaration of confidentiality.</p>
                <p>EGRAPHIC DMCC can change this policy of time to other by updating this page. You must check this page from time to time to make sure that you are satisfied with the changes. This policy is starting from November 1st, 2011.</p>
            </div>
    	</div>
    </section>
    @endsection

    @section('content')
    <main>
        <section class="terms-condition-section">                    
        	<div class="gray-bg">
        		<div class="container">
        			<h3>What we collect</h3>
        			<p>We collect the following information:</p>
        			<p>Title, First name, Name, Address supplement, Postal code, City, Country <br>
    				e-mail and Password (useful to create an account and to manage your/your XXSIM), <br>
    				Nr. of current telephone (not XXSIM), Birth date <br>
    				Possibly company</p>
        		</div>
        	</div> 
        	<div>
        		<div class="container">
        			<h3>What we do with information that we collect</h3>
        			<p>We need this information to understand your needs and to provide you with a better service, in particular for the following reasons:</p>
        			<p>Sending of ordered XXSIM <br>
    				Improvement of our products and services <br>
    				To send promotional e-mails about new products, special offers or other information of which we think that you find interesting. We use the e-mail address which you provided.</p>
        		</div>
        	</div> 
        	<div class="gray-bg">
        		<div class="container">
        			<h3>Safety</h3>
        			<p>We ensure that your information is secure. In order to prevent an unauthorized access or disclosure, we set up physical, electronic procedures to safeguard and secure information which we collect online.</p>
        		</div>
        	</div> 
        	<div>
        		<div class="container">
        			<h3>How we use cookies</h3>
        			<p>We use cookies of traffic to identify the pages which are used. That helps us to analyze data about the traffic of Web pages and help us improve our site in order to adapt it to the customer requirements. We use this information for statistical analysis before the data is removed from the system.</p>
        			<p>Globally, the cookies help us to provide you with a higher quality Website, while enabling us to follow the pages which you find useful and which you do not like. A cookie does not give us access to your computer or any other information on your subject, other than the data which you choose to share with us. You can choose to accept or refuse the cookies. Most web browsers automatically accept the cookies, but you can also modify the parameters of your browser to refuse the cookies if you prefer that (which will prevent you from benefitting fully from the site).</p>
        			<p>Control of your personal information We won’t sell, distribute or will not rent your personal information to thirds. We use your personal information to send to you products or promotional information relative to thirds which we think that you will find interesting.</p>
        			<p>You can ask for details on the personal information about your subject within the framework of the datalawin Switzerland. If you wish to obtain a copy of the information held about you, please contact our <a href="mailto:support@xxsim.com">support@xxsim.com</a>.</p>
        			<p>If you believe that the information on your subject is inaccurate or incomplete, please write us an e-mail as soon as possible, to the address above. We will correct any information that is considered incomplete or inaccurate without delay.</p>
        		</div>
        	</div>    	 
        </section>
    </main>
    @endsection
@endif