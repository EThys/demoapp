<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TABLEAU DE BORD') }}
        </h2>
    </x-slot>

    <link  href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"  rel = "stylesheet" > 
<section class="intro">
    <div class="bg-image h-100" style="background-color: #f5f7fa;">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card">
                <div class="card-body p-0">
                  <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                    <table class="table table-striped mb-0">
                      <thead style="background-color: #002d72;">
                        
                      @php
                         // $qrcode= QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9');
                          //var_dump($message);
                      @endphp
                        <tr>
                          <th scope="col">Nom</th>
                          <th scope="col">Prénom</th>
                          <th scope="col">Numero</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Like a butterfly</td>
                          <td>Boxing</td>
                          <td>9:00 AM - 11:00 AM</td>
                          <td>Aaron Chapman</td>
                        </tr>
                        <tr>
                          <td>Mind &amp; Body</td>
                          <td>Yoga</td>
                          <td>8:00 AM - 9:00 AM</td>
                          <td>Adam Stewart</td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
</x-app-layout>
