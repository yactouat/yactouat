@extends('components.layout')

@section('title', 'privacy policy')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-xl font-semibold mb-4">Privacy policy</h1>
        <p class="mb-4">Welcome to yactouat.com's privacy policy.</p>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Purpose of this policy</h2>
        <section>
            <p>Your privacy is critically important to us. At yactouat.com, we have a few fundamental principles:</p>
            <ul>
                <li>We are committed to safeguarding the privacy of our website visitors and service users.</li>
                <li>We only collect and use personal data in ways that are necessary for us to provide you with our best service and to enhance your experience on our blog.</li>
                <li>Transparency is key. We aim to make it as clear as possible what information we collect, why we collect it, and how we use it.</li>
            </ul>
            <p>This Privacy Policy document contains types of information that is collected and recorded by yactouat.com and how we use it. Our Privacy Policy applies to all visitors, users, and others who access or use the Service.</p>
            <p>By using our blog, you agree to the collection and use of information in accordance with this policy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us at {{ config("mail.reply_to.address") }}</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Information collection</h2>
        <section>
            <p>At yactouat.com, we collect various types of information for several purposes to provide and improve our service to you. The types of data we collect are as follows:</p>
            <ul>
                <li>Personal identifiable information ("Personal data"), may include but is no limited to: email address, name, cookies and usage data.</li>
                <li>Usage data: we may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g., IP address), browser type, browser version, the pages of our blog that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers, and other diagnostic data.</li>
                <li>Tracking & Cookies Data: use cookies and similar tracking technologies to track the activity on our blog and hold certain information. Cookies are files with a small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Other tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze our blog. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our blog.</li>
            </ul>
            <p>The information we collect is used to provide and maintain the blog, to notify you about changes to our blog, to allow you to participate in interactive features of our blog when you choose to do so, to provide customer support, to gather analysis or valuable information so that we can improve the blog, to monitor the usage of the blog, to detect, prevent and address technical issues, and to provide you with news, special offers and general information about other goods, services and events which we offer.</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Use of information</h2>
        <section>
            <p>The information we collect serves various purposes in enhancing your experience on yactouat.com. We use the collected data for several specific purposes:</p>
            <ul>
                <li>To Provide and Maintain our Service: Using the information helps us ensure that our blog is functioning correctly and allows us to make necessary improvements. This includes not only the technical aspects but also content and feature updates.</li>
                <li>To Notify You About Changes: We may use your Personal Data to contact you with newsletters, marketing or promotional materials, and other information that may be of interest to you. However, you will have the option to opt out of receiving any, or all, of these communications from us by following the unsubscribe link or instructions provided in any email we send.</li>
                <li>To Allow Participation in Interactive Features: When you choose to use interactive features of our blog, such as comments or forums, your information may be visible to other users and can be read, collected, or used by them. You are responsible for the personal information you choose to share in these instances.</li>
                <li>To Provide Customer Support: Information you provide helps us respond to your customer service requests and support needs more efficiently.</li>
                <li>To Gather Analysis or Valuable Information So That We Can Improve the Blog: We constantly strive to improve our blog offerings based on the information and feedback we receive from you.</li>
                <li>To Monitor the Usage of the Blog: Tracking how our blog is used helps us detect and address technical issues, and to plan for future enhancements and features.</li>
                <li>To Detect, Prevent and Address Technical Issues: Your information helps us to create a safer, secure environment on our blog by preventing and addressing security breaches and technical issues.</li>
                <li>To Provide You with News, Special Offers and General Information: We may use your information to inform you about goods, services, and events offered by us that are similar to those that you have already purchased or enquired about unless you have opted not to receive such information.</li>
            </ul>
            <p>The use of your information is primarily aimed at providing and enhancing the services we offer. We commit to handling your information responsibly and in accordance with your preferences and applicable laws.</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Cookies and tracking technologies</h2>
        <section>
            <p>These are the cookies and tracking technologies we use on this website:</p>
            <ul>
                <li>PHP sessions (server-side) to keep your authentication state up. You can un authenticate at any time directly in yactouat.com.</li>
                <li>CSRF tokens to make sure that the form you are sending to us originates from our website (cross-site request forgery mitigation).</li>
                <li>Cookie consent is stored on your browser to keep track of your acceptance of this privacy policy.</li>
            </ul>
            <p>The use of these cookies is primarily aimed at providing and enhancing the services we offer. We commit to handling your information responsibly and in accordance with your preferences and applicable laws.</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Data security</h2>
        <section>
            <p>These are the measures we take to ensure that your personal data is safe:</p>
            <ul>
                <li>We encrypt your user password.</li>
                <li>We send emails one by one and not in batches so that other users may never accidentely discover that you're part of yactouat.com community.</li>
                <li>We deploy this site on an environment using TLS encryption in order to mitigate man-in-the-middle attacks.</li>
                <li>We encrypt the information between our application and the database in order to mitigate man-in-the-middle attacks.</li>
            </ul>
            <p>We aim at providing our very best effort to keep your privacy safe.</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">User rights</h2>
        <section>
            <p>These are your rights as a user of this site:</p>
            <ul>
                <li>You can update your personal information by going to your profile page.</li>
                <li>You can delete your account by going to your profile page.</li>
                <li>You can request a copy of your personal data by sending us an email at {{ config("mail.reply_to.address") }}.</li>
                <li>You can enquire about anything related to your personal data by sending us an email at {{ config("mail.reply_to.address") }}</li>
            </ul>
            <p>We aim at providing our very best effort to keep your privacy safe.</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Changes to the privacy policy</h2>
        <section>
            <p>Should this privacy policy terms change, users will be notified by email and/or a notice on our blog. You are advised to review this privacy policy periodically for any changes. Changes to this privacy policy are effective when they are posted on this page.</p>
        </section>

        <hr class="my-8">

        <h2 class="text-lg font-semibold mt-6 mb-2">Contact Information</h2>
        <p>Email: <a href="mailto:{{ config('mail.reply_to.address') }}" class="text-gray-500 underline">{{ config("mail.reply_to.address") }}</a></p>
    </div>    
@endsection
