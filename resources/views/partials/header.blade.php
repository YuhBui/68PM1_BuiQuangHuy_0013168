@push('styles')
<style>
    .header {
      background: var(--c-header);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      /* position: sticky giữ header dính khi cuộn trang */
      position: sticky;
      top: 0;
      z-index: 10;
      min-height: var(--header-height);
    }

    .header .logo {
      font-size: 20px;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-decoration: none;
      color: #fff;
    }

    .header .logo span {
      color: var(--c-accent);
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .header nav ul {
      display: flex;
      gap: 20px;
      list-style: none;
      margin-bottom: 0;
      padding-left: 0;
    }

    .header nav a {
      color: #d9e4f0;
      text-decoration: none;
      font-size: 15px;
      padding: 6px 4px;
      border-bottom: 2px solid transparent;
      transition: color 0.2s, border-color 0.2s;
    }

    .header nav a:hover,
    .header nav a:focus {
      color: #fff;
      border-bottom-color: var(--c-accent);
    }

    .header-auth {
      display: flex;
      align-items: center;
      gap: 12px;
      border-left: 1px solid rgba(255, 255, 255, 0.2);
      padding-left: 18px;
    }

    .header-auth .auth-username {
      color: #ffffff;
      font-size: 14px;
      font-weight: 600;
      background: rgba(255, 255, 255, 0.12);
      padding: 4px 12px;
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .header-auth .btn-logout {
      border-radius: 6px;
      font-size: 13px;
      padding: 4px 10px;
    }

    .header-auth .btn-auth-login {
      border-radius: 6px;
      font-size: 13px;
      padding: 4px 12px;
    }

    .header-auth .btn-auth-register {
      background: var(--c-accent);
      border-color: var(--c-accent);
      color: #1e3a5f;
      font-weight: 600;
      border-radius: 6px;
      font-size: 13px;
      padding: 4px 12px;
    }
    .header-auth .btn-auth-register:hover {
      background: #e09618;
      border-color: #e09618;
      color: #1e3a5f;
    }
</style>
@endpush
<header class="header">
      <a href="{{ url('/') }}" class="logo">HUCE<span>.Web</span></a>

      <div class="header-right">
        <nav>
          <ul>
            @if (isset($menuHienThi))
              @foreach ($menuHienThi->get('header', []) as $menu)
                @if ((str_contains($menu->url, '/menu') || str_contains(mb_strtolower($menu->ten), 'menu')) && (!Auth::check() || !Auth::user()->isAdmin()))
                  @continue
                @endif
                <li><a href="{{ $menu->url }}">{{ $menu->ten }}</a></li>
              @endforeach
            @endif
          </ul>
        </nav>

        <div class="header-auth">
          @auth
            <span class="auth-username">
              👤 {{ Auth::user()->name }}
              @if (Auth::user()->isAdmin())
                <span class="badge bg-warning text-dark ms-1" style="font-size: 10px; padding: 2px 6px;">Admin</span>
              @endif
            </span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-logout">Đăng xuất</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-auth-login">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-auth-register">Đăng ký</a>
          @endauth
        </div>
      </div>
</header>