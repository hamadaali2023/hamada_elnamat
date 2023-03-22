    
@extends('layout.instructor.main')
@section('content') 

@toastr_css



@toastr_css

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">المستخدمين</h3><br>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">المستخدمين    </li>
                    </ol> 
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="dropdown float-md-right">
                <a href="{{route('stories.create')}}"  class="btn btn-primary float-right mt-2">أضافة كتاب</a>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>خطا</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <section id="search-images" class="card overflow-hidden">
         <div class="card-header">
            <h4 class="card-title">Images search results</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                <li><a data-action="close"><i class="ft-x"></i></a></li>
              </ul>
            </div>
          </div>
        <div class="card-content">
            <div class="card-body pb-0">
              <fieldset class="form-group position-relative mb-0">
                <form method="get" action="{{url('instructor/stories')}}">
                    <input name="searchname" type="text" class="form-control form-control-xl input-xl" id="iconLeft1" placeholder="Explore Modern ...">
                </form>
                <div class="form-control-position">
                  <i class="ft-mic font-medium-4"></i>
                </div>
              </fieldset>
            </div>
            <div id="search-results" class="card-body">
              <div >

                <div class="card-deck-wrapper">
                  <div class="card-deck">
                  
                    @foreach ($books as $_item)
                    <div class="col-md-3">
                      <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
                      itemscope itemtype="http://schema.org/ImageObject">
                        <a href="../../../app-assets/images/gallery/1.jpg" itemprop="contentUrl" data-size="480x360">
                          <img class="gallery-thumbnail card-img-top" src="{{asset('img/books/'.$_item->photo)}}"
                          itemprop="thumbnail" alt="Image description" />
                        </a>

                        <div class="card-body px-0">
                            <div class="content-header-right col-md-12 col-12">
                                <div class="dropdown float-md-right">
                                    <button class="dropdown-toggle"  data-toggle="dropdown" style="border: none;padding-left: 18px;">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
                                       <a class="btn btn-sm bg-success-light dropdown-item" href="{{asset('img/books/'.$_item->file)}}"><i class="fe fe-pencil"></i> عرض</a>
                                       <a class="btn btn-sm bg-success-light dropdown-item" href="{{route('stories.edit',$_item->id)}}"><i class="fe fe-pencil"></i> تعديل</a>
                                       <a class="btn btn-sm bg-danger-light dropdown-item" data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete" >
                                            <i class="fe fe-trash"></i> حذف
                                      </a>

                                    </div>
                                </div>
                            </div>

                            <p>
                                <span class="text-bold-600">{{ $_item->name }}</span> 
                            </p>
                            <p class="card-text">{!! Str::limit( $_item->description, 60, ' ...') !!}</p>
                        </div>

                      </figure>

                    </div>

                    @endforeach
                  </div>

                </div>
                {!! $books->appends(['sort' => 'votes'])->links() !!}
                <!-- <div class="text-center">
                  <nav aria-label="Page navigation">
                    <ul class="pagination pagination-separate pagination-round pagination-flat">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">« Prev</span>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>

                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item active"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">Next »</span>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div> -->

              </div>
            </div>
          </div>
    <div class="modal fade" id="delete" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                    <!--    <div class="modal-header">
                            <h5 class="modal-title">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>-->
                        <div class="modal-body">
                            <div class="form-content p-2">
                                <h4 class="modal-title">حذف</h4>
                                <p class="mb-4">هل انت متأكد من حذف هذا العنصر ؟</p>
                                <div class="row text-center">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-2">
                                        <form method="post" action="{{route('stories.destroy','test')}}">
                                             @csrf
                                             @method('delete')
                                             <input type="hidden" name="id" id="cat_id" >
                                            <button type="submit" class="btn btn-primary">حذف </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var cat_id = button.data('catid') 
            var modal = $(this)
            modal.find('.modal-body #cat_id').val(cat_id);
        });
    </script>
</section>

@toastr_js
@toastr_render
@endsection
