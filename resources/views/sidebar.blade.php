    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/admin" class="brand-link" style="text-decoration: none;">
      <img src="/template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Dashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <a class="rounded" href="/profile">
              <img class="rounded" src="{{ Auth::user()->image }}" alt="User Image">
            </a>
          </div>
          <div class="info">
          <a style="text-decoration: none" href="/profile" class="d-block">
            @auth
              Welcome, {{ Auth::user()->name }}!
              {{-- <p>Your email: {{ Auth::user()->email }}</p> --}}
              {{-- <p>Your role: {{ Auth::user()->role }}</p> --}}
          @endauth
          </a>
          </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
              <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
              </button>
          </div>
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
              {{-- level 0 --}}
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    
                    <p>
                      Quản lý nhân sự
                {{-- cấp 0 quản lý nhân sự --}}
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                    {{-- cấp 1 quản lý nhân viên --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          {{-- quản lý nhân viên --}}
                          Quản lý nhân viên
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/employ/add" class="nav-link">
                            
                            <p>Thêm nhân viên</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/employ/List" class="nav-link">
                            
                            <p>Danh sách nhân viên</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý OT --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          {{-- quản lý nhân viên --}}
                          OT
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/OT/phieu" class="nav-link">
                            
                            <p>Phiếu ghi nhận phụ trội</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/OT/chitiet" class="nav-link">
                            
                            <p>Chi tiết phụ trội</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý quyết định tuyển dụng --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          {{-- quản lý nhân viên --}}
                          Quyết định tuyển dụng
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/hiring/List" class="nav-link">
                            
                            <p>Xem tất cả quyết định TD</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/hiring/add" class="nav-link">
                            
                            <p>Thêm quyết định TD</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý khen thưởng / kỷ luật --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          Khen thưởng | Kỷ luật
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/reward-discipline/decide" class="nav-link">
                            
                            <p>Quyết định</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/reward-discipline/individual" class="nav-link">
                            
                            <p>Cá nhân</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/reward-discipline/collective" class="nav-link">
                            
                            <p>Tập thể</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý hợp đồng --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          Hợp đồng
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/contract" class="nav-link">
                            
                            <p>Danh sách hợp đồng</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/contract-type" class="nav-link">
                            
                            <p>Loại hợp đồng</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý Bảo hiểm --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          Bảo hiểm
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/insurance" class="nav-link">
                            
                            <p>Danh sách Bảo hiểm</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/insurance-book" class="nav-link">
                            
                            <p>Sổ Bảo hiểm</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý lương --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          Quản lý lương
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/salary-decision" class="nav-link">
                            
                            <p>Quyết định lương</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/salary_allowance" class="nav-link">
                            
                            <p>Phụ cấp lương</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý Chức vụ --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          Quản lý Chức vụ
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/position-decision" class="nav-link">
                            
                            <p>Quyết định chức vụ</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/admin/position-detail" class="nav-link">
                            
                            <p>Chi tiết QĐCV</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  {{-- cấp 1 quản lý chấm công --}}
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}
                        <p>
                          Quản lý Chấm công
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="/admin/timekeeping" class="nav-link">
                            
                            <p>Danh sách chấm công</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
              </li>

              {{-- level 0 --}}
              {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                  
                  <p>
                    Quản lý Phòng ban --}}
              {{-- cấp 1 quản lý phòng ban --}}
                    {{-- <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="/admin/department/List" class="nav-link">
                      
                      <p>Xem tất cả phòng ban</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/department/add" class="nav-link">
                      
                      <p>Thêm phòng ban</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="/admin/allowance/" class="nav-link">
                  
                  <p>Phụ cấp</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/position/" class="nav-link">
                  
                  <p>Chức vụ</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item">
                <a href="/chat" class="nav-link">
                  
                  <p>Phòng chat</p>
                </a>
              </li> --}}

              <li class="nav-item">
                <a href="#" class="nav-link">
                  
                  <p>
                    Master data
              {{-- cấp 0 quản lý nhân sự --}}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  {{-- cấp 1 quản lý nhân viên --}}
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      {{-- <i class="far fa-circle nav-icon"></i> --}}
                      <p>
                        {{-- quản lý nhân viên --}}
                        Quản lí phòng ban
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      <li class="nav-item">
                        <a href="/admin/department/List" class="nav-link">
                          
                          <p>Xem tất cả phòng ban</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/admin/department/add" class="nav-link">
                          
                          <p>Thêm phòng ban</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="nav-item">
                    <a href="/admin/allowance/" class="nav-link">
                      
                      <p>Phụ cấp</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/position/" class="nav-link">
                      
                      <p>Chức vụ</p>
                    </a>
                  </li>
                </ul>

                <li class="nav-item">
                  <a href="/chat" class="nav-link">
                    
                    <p>Phòng chat</p>
                    <span id="unreadMessages" class="rounded-circle bg-danger p-1 ml-3 d-none" style="font-size:12px"></span>
                  </a>
                </li>

                <li class="nav-item">
                  <form action="{{url('/vnpay_payment')}}" class="m-0" method="post">
                      @csrf
                      <button type="submit" name="redirect" class="nav-link">
                        
                        <p>Thanh toán VNPay</p>
                        <span id="unreadMessages" class="rounded-circle bg-danger p-1 ml-3 d-none" style="font-size:12px"></span>
                      </button>
                   </form>
                </li>

                <li class="nav-item">
                  <form action="{{url('/momo_payment')}}" class="m-0" method="post">
                      @csrf
                      <button type="submit" name="payUrl" class="nav-link">
                        
                        <p>Thanh toán MOMO bằng TK NH</p>
                        <span id="unreadMessages" class="rounded-circle bg-danger p-1 ml-3 d-none" style="font-size:12px"></span>
                      </button>
                   </form>
                </li>

                <li class="nav-item">
                  <form action="{{url('momo_paymentQR')}}" class="m-0" method="post">
                      @csrf
                      <button type="submit" name="payUrl" class="nav-link">
                        
                        <p>Thanh toán MOMO QR Code</p>
                        <span id="unreadMessages" class="rounded-circle bg-danger p-1 ml-3 d-none" style="font-size:12px"></span>
                      </button>
                   </form>
                </li>
                
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>