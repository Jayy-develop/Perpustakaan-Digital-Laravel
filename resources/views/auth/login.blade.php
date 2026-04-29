<x-guest-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

/* Background */
body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#020617;
overflow:hidden;
}

/* Animated luxury glow */
body::before{
content:"";
position:absolute;
width:700px;
height:700px;
background:radial-gradient(circle,#6366f1,transparent);
filter:blur(200px);
top:-200px;
left:-200px;
opacity:.4;
}

body::after{
content:"";
position:absolute;
width:600px;
height:600px;
background:radial-gradient(circle,#9333ea,transparent);
filter:blur(180px);
bottom:-200px;
right:-200px;
opacity:.4;
}

/* Glass Card */
.card{
width:420px;
padding:50px;
border-radius:25px;
background:rgba(255,255,255,0.06);
backdrop-filter:blur(30px);
border:1px solid rgba(255,255,255,0.15);
box-shadow:
0 40px 80px rgba(0,0,0,0.6),
inset 0 0 40px rgba(255,255,255,0.05);
color:blue;
}

/* Title */
.card h1{
font-size:32px;
font-weight:600;
text-align:center;
margin-bottom:10px;
}

.subtitle{
text-align:center;
color:#94a3b8;
margin-bottom:35px;
font-size:14px;
}

/* Input */
.group{
margin-bottom:22px;
}

.group label{
font-size:13px;
color:#cbd5f5;
display:block;
margin-bottom:6px;
}

.input{
width:100%;
padding:14px;
border-radius:12px;
border:none;
background:rgba(255,255,255,0.12);
color:white;
outline:none;
transition:.3s;
}

.input:focus{
background:rgba(255,255,255,0.2);
box-shadow:0 0 0 2px #6366f1;
}

/* Options */
.options{
display:flex;
justify-content:space-between;
font-size:13px;
margin-top:8px;
}

/* Button */
.login-btn{
margin-top:30px;
width:100%;
padding:15px;
border-radius:14px;
border:none;
background:linear-gradient(135deg,#6366f1,#9333ea);
color:white;
font-size:16px;
cursor:pointer;
transition:.35s;
}

.login-btn:hover{
transform:translateY(-3px);
box-shadow:0 20px 40px rgba(99,102,241,.6);
}

/* Footer */
.footer{
margin-top:25px;
text-align:center;
font-size:12px;
color:#64748b;
}
</style>

<div class="card">

<h1>Sign In</h1>
<p class="subtitle">Access your premium dashboard</p>

<x-auth-session-status :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
@csrf

<div class="group">
<label>Email Address</label>
<input class="input"
type="email"
name="email"
value="{{ old('email') }}"
required autofocus
placeholder="you@email.com">
<x-input-error :messages="$errors->get('email')" />
</div>

<div class="group">
<label>Password</label>
<input class="input"
type="password"
name="password"
required
placeholder="••••••••">
<x-input-error :messages="$errors->get('password')" />
</div>

<div class="options">
<label>
<input type="checkbox" name="remember"> Remember
</label>

@if (Route::has('password.request'))
<a href="{{ route('password.request') }}" style="color:#a5b4fc;">
Forgot?
</a>
@endif
</div>

<button class="login-btn">
Login 
</button>

</form>

<div class="footer">
Secure Authentication • Laravel System
</div>

</div>

</x-guest-layout>