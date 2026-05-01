<x-guest-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* Reset */
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

/* Background */
body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#020617;
padding:20px;
}

/* Glow Effect */
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
padding:40px 30px;
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
font-size:28px;
font-weight:600;
text-align:center;
margin-bottom:10px;
}

.subtitle{
text-align:center;
color:#94a3b8;
margin-bottom:25px;
font-size:13px;
}

/* Form Group */
.group{
margin-bottom:18px;
}

.group label{
font-size:12px;
color:#cbd5f5;
display:block;
margin-bottom:5px;
}

/* Input */
.input{
width:100%;
padding:13px;
border-radius:10px;
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
font-size:12px;
margin-top:6px;
flex-wrap:wrap;
gap:10px;
}

/* Button */
.login-btn{
margin-top:25px;
width:100%;
padding:14px;
border-radius:12px;
border:none;
background:linear-gradient(135deg,#6366f1,#9333ea);
color:white;
font-size:15px;
cursor:pointer;
transition:.3s;
}

.login-btn:active{
transform:scale(0.97);
}

/* Register Link */
.register{
margin-top:18px;
text-align:center;
font-size:13px;
color:#94a3b8;
}

.register a{
color:#a5b4fc;
text-decoration:none;
font-weight:500;
}

.register a:hover{
text-decoration:underline;
}

/* Footer */
.footer{
margin-top:20px;
text-align:center;
font-size:11px;
color:#64748b;
}

/* Mobile */
@media (max-width:480px){
.card{
padding:30px 20px;
}

.card h1{
font-size:24px;
}
}
</style>

<div class="card">

<h1>Sign In</h1>
<p class="subtitle">Explore all books</p>

<x-auth-session-status :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
@csrf

<div class="group">
<label>Email Address</label>
<input 
class="input"
type="email"
name="email"
value="{{ old('email') }}"
required 
autofocus
placeholder="you@email.com">
<x-input-error :messages="$errors->get('email')" />
</div>

<div class="group">
<label>Password</label>
<input 
class="input"
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

<button type="submit" class="login-btn">
Login
</button>

</form>

<div class="register">
Belum punya akun?
<a href="{{ route('register') }}">Daftar</a>
</div>

<div class="footer">
Authentication Halaman Login
</div>

</div>

</x-guest-layout>