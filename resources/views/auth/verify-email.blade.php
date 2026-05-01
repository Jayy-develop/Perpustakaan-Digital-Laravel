<x-guest-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #312e81 100%);
            color: #f8fafc;
        }

        .verify-card {
            width: min(520px, calc(100vw - 36px));
            background: rgba(15, 23, 42, 0.92);
            border: 1px solid rgba(148, 163, 184, 0.16);
            border-radius: 32px;
            box-shadow: 0 32px 80px rgba(15, 23, 42, 0.45);
            padding: 40px;
        }

        .verify-card h1 {
            font-size: 2.1rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #e0e7ff;
        }

        .verify-card p {
            line-height: 1.8;
            color: #cbd5e1;
            margin-bottom: 24px;
        }

        .alert {
            background: rgba(56, 189, 248, 0.12);
            border: 1px solid rgba(56, 189, 248, 0.28);
            color: #e0f2fe;
            padding: 18px 20px;
            border-radius: 20px;
            margin-bottom: 24px;
        }

        .button-row {
            display: grid;
            gap: 14px;
        }

        .button-row button,
        .button-row a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 14px 20px;
            border-radius: 18px;
            font-weight: 600;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .primary-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            box-shadow: 0 16px 36px rgba(99, 102, 241, 0.28);
        }

        .secondary-btn {
            background: rgba(148, 163, 184, 0.12);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.24);
        }

        .primary-btn:hover,
        .secondary-btn:hover {
            transform: translateY(-2px);
        }

        .note {
            margin-top: 20px;
            font-size: 0.95rem;
            color: #94a3b8;
        }
    </style>

    <div class="verify-card">
        <h1>Verifikasi Email Anda</h1>

        @if (session('status') == 'verification-link-sent')
            <div class="alert">
                Tautan verifikasi baru telah dikirim ke alamat email Anda.
            </div>
        @endif

        <p>
            Terima kasih telah mendaftar! Kami telah mengirimkan email verifikasi ke alamat email Anda.
            Buka email dan klik tombol verifikasi untuk menyelesaikan pembuatan akun.
        </p>

        <div class="button-row">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="primary-btn">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="secondary-btn">
                    Keluar dari Akun
                </button>
            </form>
        </div>

        <p class="note">
            Jika Anda tidak menerima email dalam beberapa menit, periksa folder spam atau tekan tombol di atas untuk mengirim ulang.
        </p>
    </div>
</x-guest-layout>
