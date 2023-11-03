<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
       <strong>SI-PMS</strong>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
       <strong>SI-PMS</strong>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link"
                href="{{ Route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
    </ul>
    @if (!Auth::check())
        <ul class="sidebar-menu">
            <li><a class="nav-link"
                href="{{ Route('mahasiswa.index') }}"><i class="fa fa-user"></i> <span>Mahasiswa MBKM</span></a></li>
        </ul>
    @endif
    {{-- fitur untuk mahasiswa --}}
    @if (Auth::check())
        
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'rencana-kegiatan.index' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('rencana-kegiatan.index') }}"><i class="fas fa-list"></i> <span>Rencana Kegiatan</span></a></li>
        </ul>
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'loogbook' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('logbook') }}"><i class="fas fa-book"></i> <span>Log Book</span></a></li>
        </ul>
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'laporan' ? 'active' : '' }}"><a class="nav-link"
                    href="{{Route('laporan')}}"><i class="fas fa-calendar"></i> <span>Laporan</span></a></li>
        </ul>
    @endif

   

    {{-- ini fitur untuk operator --}}
    @if (Auth::guard('operators')->check())
      
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'pamong.index' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('pamong.index') }}"><i class="fa fa-cube"></i> <span>Master Pamong</span></a></li>
        </ul>    
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'dosen.index' ? 'active' : '' }}"> <a class="nav-link"
            href="{{ Route('dosen.index') }}"><i class="fa fa-cube"></i> <span>Master Dosen</span></a></li>
        </ul>    
        
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'operator.index' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('operator.index') }}"><i class="fa fa-cube"></i> <span>Master Operator</span></a></li>
        </ul>    
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'post.index' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('post.index') }}"><i class="fa fa-pen"></i> <span>Post</span></a></li>
        </ul>    
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'dosen.index' ? 'active' : '' }}"><a class="nav-link"
                    href="{{Route('pengaturan.index')}}"><i class="fa fa-wrench"></i> <span>Pengaturan</span></a></li>
        </ul>    
    @endif
</aside>
