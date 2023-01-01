<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Category <b>   </b>

        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class='col-md-8'>
                <div class="card">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"style='color: #000;'>
                     <strong>{{ session('success')}}</strong>
                      <button type="button" class="btn-close btn btn-success" data-bs-dismiss="alert" aria-label="Close" ></button>
                    </div>
                @endif
                    <div class="card-header">
                        All category
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">created at</th>
                           <th scope="col">control</th>

                        </tr>
                        </thead>
                        <tbody>
                            {{-- @php($i =1) --}}
                            @foreach ($categories as $category)


                        <tr>
                            <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->user->name }}</td>
                            <td>
                                @if ($category->created_at == Null)
                                    <span class="text-danger">No DATE Set</span>
                                @else
                                {{ carbon\carbon::parse($category->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ URL('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $categories->links() }}

                </div>
            </div>

            <div class='col-md-4'>
                <div class="card">

                    <div class="card-header">
                        ADD category
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('category_name')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" style='color:black;'>Add caregory</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>
    {{-- Trash Part --}}



    <div class="container">
        <div class="row">
            <div class='col-md-8'>
             <div class="card">
                 
                 <div class="card-header">
                     Trash List
                 </div>

                 <table class="table">
                     <thead>
                     <tr>
                         <th scope="col">sl no</th>
                         <th scope="col">Category Name</th>
                         <th scope="col">User</th>
                         <th scope="col">created at</th>
                        <th scope="col">control</th>

                     </tr>
                     </thead>
                     <tbody>
                         {{-- @php($i =1) --}}
                         @foreach ($trachCat as $category)


                     <tr>
                         <th scope="row">{{ $trachCat->firstItem()+$loop->index }}</th>
                         <td>{{ $category->category_name }}</td>
                         <td>{{ $category->user->name }}</td>
                         <td>
                             @if ($category->created_at == Null)
                                 <span class="text-danger">No DATE Set</span>
                             @else
                             {{ carbon\carbon::parse($category->created_at)->diffForHumans() }}
                             @endif
                         </td>
                         <td>
                             <a href="{{ URL('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                             <a href="{{ URL('pdelete/category/'.$category->id) }}" class="btn btn-danger">PER Delete</a>
                         </td>
                     </tr>
                     @endforeach

                     </tbody>
                 </table>
                 {{ $trachCat->links() }}

             </div>
         </div>

         <div class='col-md-4'>
             
         </div>

            {{-- End Trash  --}}



      </div>
 </div>
















    </div>
</x-app-layout>
