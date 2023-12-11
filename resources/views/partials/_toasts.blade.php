@if (session()->has('user.create.success'))
    <x-toast-message>
        <p>{{ session('user.create.success') }}</p>
    </x-toast-message>
@elseif (session()->has('user.login.success'))
    <x-toast-message>
        <p>{{ session('user.login.success') }}</p>
    </x-toast-message>  
@elseif (session()->has('user.signupForNewsletter.success'))
    <x-toast-message>
        <p>{{ session('user.signupForNewsletter.success') }}</p>
    </x-toast-message>
@elseif (session()->has('post.comment.success'))
    <x-toast-message>
        <p>{{ session('post.comment.success') }}</p>
    </x-toast-message>
@elseif (session()->has('user.profile-update.success'))
    <x-toast-message>
        <p>{{ session('user.profile-update.success') }}</p>
    </x-toast-message>
@elseif (session()->has('user.profile-deletion.success'))
    <x-toast-message>
        <p>{{ session('user.profile-deletion.success') }}</p>
    </x-toast-message>
@elseif (session()->has('message.success'))
    <x-toast-message>
        <p>{{ session('message.success') }}</p>
    </x-toast-message>
@elseif (session()->has('user.sendPasswordResetLink.success'))
    <x-toast-message>
        <p>{{ session('user.sendPasswordResetLink.success') }}</p>
    </x-toast-message>
@elseif (session()->has('user.signupForNewsletter.error'))
    <x-toast-message
        class="bg-red-500"
    >
        <p>{{ session('user.signupForNewsletter.error') }}</p>
    </x-toast-message>
@elseif (session()->has('message.error'))
    <x-toast-message
        class="bg-red-500"
    >
        <p>{{ session('message.error') }}</p>
    </x-toast-message>
@elseif (session()->has('post.comment.error'))
    <x-toast-message
        class="bg-red-500"
    >
        <p>{{ session('post.comment.error') }}</p>
    </x-toast-message>
@endif

@if (session()->has('user.create.success') || session()->has('user.login.success') || session()->has('user.signupForNewsletter.success') 
    || session()->has('post.comment.success') || session()->has('user.profile-update.success') || session()->has('user.profile-deletion.success')
    || session()->has('message.success')) || session()->has('user.sendPasswordResetLink.success')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            showToastMessage(5000);
        });
    </script>
@elseif (session()->has('user.signupForNewsletter.error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            showToastMessage(10000);
        });
        window.addEventListener('DOMContentLoaded', function () {
            document.querySelector('#app-footer').scrollIntoView();
        });
    </script>
@elseif (session()->has('post.comment.error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            showToastMessage(10000);
        });
        window.addEventListener('DOMContentLoaded', function () {
            document.querySelector('#post-comments').scrollIntoView();
        });
    </script>
@elseif (session()->has('message.error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            showToastMessage(10000);
        });
        window.addEventListener('DOMContentLoaded', function () {
            document.querySelector('#app-contact').scrollIntoView();
        });
    </script>
@endif