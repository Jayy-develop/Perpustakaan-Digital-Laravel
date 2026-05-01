<x-guest-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#020617;
padding:20px;
}

/* Glow */
body::before,
body::after{
content:"";
position:absolute;
width:600px;
height:600px;
filter:blur(180px);
opacity:.4;
pointer-events:none;
}

body::before{
background:radial-gradient(circle,#6366f1,transparent);
top:-200px;
left:-200px;
}

body::after{
background:radial-gradient(circle,#9333ea,transparent);
bottom:-200px;
right:-200px;
}

/* Card */
.card{
width:100%;
max-width:420px;
padding:35px 25px;
border-radius:20px;
background:rgba(255,255,255,0.06);
backdrop-filter:blur(25px);
border:1px solid rgba(255,255,255,0.1);
box-shadow:
0 30px 60px rgba(0,0,0,0.5),
inset 0 0 20px rgba(255,255,255,0.05);
color:white;
}

/* Title */
.card h1{
font-size:26px;
text-align:center;
margin-bottom:10px;
}

.subtitle{
text-align:center;
color:#94a3b8;
margin-bottom:25px;
font-size:13px;
}

/* Input */
.group{
margin-bottom:18px;
}

.group label{
font-size:12px;
color:#cbd5f5;
display:block;
margin-bottom:5px;
}

.input{
width:100%;
padding:13px;
border-radius:10px;
border:none;
background:rgba(255,255,255,0.12);
color:white;
outline:none;
}

.input:focus{
background:rgba(255,255,255,0.2);
box-shadow:0 0 0 2px #6366f1;
}

/* Button */
.btn{
margin-top:20px;
width:100%;
padding:14px;
border-radius:12px;
border:none;
background:linear-gradient(135deg,#6366f1,#9333ea);
color:white;
cursor:pointer;
}

/* Error */
.error{
color:#f87171;
font-size:12px;
margin-top:5px;
}
</style>

<div class="card">

<h1>Reset Password</h1>
<p class="subtitle">Create your new password</p>

<form method="POST" action="{{ route('password.store') }}">
@csrf

<input type="hidden" name="token" value="{{ $request->route('token') }}">

<div class="group">
<label>Email</label>
<input class="input" type="email" name="email"
value="{{ old('email', $request->email) }}" required>
<x-input-error :messages="$errors->get('email')" class="error" />
</div>

<div class="group">
<label>New Password</label>
<input class="input" type="password" name="password" required>
<x-input-error :messages="$errors->get('password')" class="error" />
</div>

<div class="group">
<label>Confirm Password</label>
<input class="input" type="password" name="password_confirmation" required>
<x-input-error :messages="$errors->get('password_confirmation')" class="error" />
</div>

<button type="submit" class="btn">
Reset Password
</button>

</form>

</div>

</x-guest-layout>