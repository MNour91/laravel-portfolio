<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Hi .... <b>  {{ Auth::user()->name }} </b>
          <b style='float:right;'>Total Users <span class='badge bg-danger'>{{ count($users)}}  </span></b>
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">sl no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">created at</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $row)

                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ carbon\carbon::parse($row->created_at)->diffForHumans() }}</td>
                  </tr>
                  @endforeach

                </tbody>
              </table>

           </div>

       </div>


    </div>
</x-app-layout>
