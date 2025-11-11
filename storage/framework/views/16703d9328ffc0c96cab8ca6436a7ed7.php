
<?php $__env->startSection('title', 'Privacy'); ?>
<?php $__env->startSection('content'); ?>
<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title">
						<h1><?php echo e($settings->title); ?> Privacy Policy</h1>	</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-10 offset-xl-1">
					<div class="article">
						<!-- article content -->
						<div class="article__content">
							<div class="article__meta">
								<a href="#" class="article__category text-red">MineWatts Privacy Policy</a>

								<span class="article__date"><i class="ti ti-calendar-up"></i><?php echo e(now()->year); ?></span>
							</div>

							<p>This Privacy Policy describes how <?php echo e($settings->title); ?> (“we,” “us,” or “our”) collects, uses, discloses, and safeguards your information when you visit 
							our website or use any of our services, including but not limited to cloud mining, digital asset storage, and financial transactions. By accessing 
							or using the <?php echo e($settings->title); ?> platform, you consent to the practices described in this policy.</p>
							
								<h2>Information We Collect</h2>
								
							<p>We collect the following types of information to provide and improve our services:</p>

							<h3>1.1. Personal Information</h3>

							<p>Full name, Email address, Phone number, Country and address (if applicable), Wallet addresses (cryptocurrencies), Government-issued identification (for KYC purposes), Payment information (via third-party gateways)</P><br>

<h3>1.2. Technical and Usage Information</h3>

<p>IP address, Browser type and version, Device type and operating system, Referral source, Pages visited, session duration, and click patterns, Date and time of access, Transaction and activity logs</p>

							<h3>2. Use of Information</h3>

							<p>We use the collected information for the following purposes:<br>

To register and manage user accounts<br>

To process transactions, withdrawals, and deposits<br>

To verify identities and comply with KYC/AML requirements<br>

To provide customer support and resolve disputes<br>

To monitor usage and improve the functionality of the platform<br>

To detect and prevent fraudulent or illegal activities<br>

To communicate service updates, promotional content, or administrative information<br>

To comply with applicable laws and regulations</p>

					<h3>3. Legal Basis for Processing</h3>

							<p>

Depending on your jurisdiction, we process your personal data based on the following legal grounds:<br>

Your consent<br>

The necessity of the data for the performance of a contract<br>

Compliance with legal obligations<br>

Legitimate interests pursued by <?php echo e($settings->title); ?>, including fraud prevention and service improvement.</p>

<h3>4. Data Retention</h3>

<p>We retain personal data only for as long as necessary to fulfill the purposes outlined in this policy, including legal, accounting, or reporting requirements. Upon expiration of the retention period, personal data will be securely deleted or anonymized.</p>

<h3>5. Data Sharing and Disclosure</h3>

<p>We do not sell or rent personal information. However, we may share your information with:<br>

Regulatory authorities or law enforcement, when legally required<br>

Payment processors, KYC/AML service providers, and hosting partners under strict confidentiality agreements<br>

Legal counsel or professional advisors in connection with dispute resolution or legal compliance</p>

<h3>6. International Data Transfers</h3>

<p>Your personal information may be transferred to and maintained on servers located in different jurisdictions, including but not limited to the United States, the European Union, and Asia. These jurisdictions may have data protection laws that differ from your own. In such cases, we take appropriate safeguards to ensure your data remains protected.</p>

<h3>7. Security of Data</h3>

<p>We implement appropriate technical and organizational security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction, including but not limited to:<br>

Encrypted data storage<br>

Secure Socket Layer (SSL) encryption<br>

Two-Factor Authentication (2FA)<br>

Limited staff access based on role and necessity<br>

Regular security audits and vulnerability assessments</p>

<h3>8. Your Rights</h3>

<p>Subject to applicable data protection laws, you may have the right to:<br>

Access the personal data we hold about you<br>

Correct any inaccuracies in your data<br>

Request deletion of your data under certain conditions<br>

Withdraw your consent for data processing<br>

Object to or restrict certain types of data processing<br>

Request a copy of your data in a portable format<br>

To exercise any of these rights, please contact us at support{{ $settings->title }}.com.</p>

<h3>9. Cookies and Tracking Technologies</h3>

<p><?php echo e($settings->title); ?> uses cookies and similar technologies to enhance user experience and gather statistical data. You may choose to disable cookies through your browser settings, though doing so may affect the functionality of the platform.</p>

<h3>10. Children's Privacy</h3>

<p><?php echo e($settings->title); ?> does not knowingly collect or solicit data from anyone under the age of 18. If we discover that such data has been collected, it will be promptly deleted.</p>

<h3>11. Third-Party Links</h3>

<p>Our platform may contain links to third-party websites or services. We are not responsible for the content, privacy policies, or practices of those third parties.</p>

<h3>12. Changes to This Policy</h3>

<p>We reserve the right to amend this Privacy Policy at any time. Updates will be posted on this page with an updated "Last Updated" date. You are encouraged to review this policy periodically.</p>

<h3>13. Contact Information</h3>

<p>If you have any questions, concerns, or requests regarding this Privacy Policy or your personal data, you may contact us at:</p>

<p><?php echo e($settings->title); ?><br>
Email: support@minewatts.com<br>
Website: www.<?php echo e($settings->title); ?>.com<p>
							
						</div>
						<!-- end article content -->

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end article -->
		<?php $__env->stopSection(); ?>
	
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/pages/privacy.blade.php ENDPATH**/ ?>