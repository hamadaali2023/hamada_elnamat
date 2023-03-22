@extends('layout.front_main')
@section('content') 


    <section class="team-section">
        <div class="container">

            <div class="row">

                <div class="col-md-12 text-center">
                    <div class="heading_title">
                        <span class="heading_divider"></span>
                        <!--Our Executive Instructors-->
                        <h3>المدربين التنفيذيين لدينا</h3>
                        <p>نفتخر ونرتقي بفريق المدربين
                            <!--<br> and creative style providing a full-service solution to our clients.-->
                            </p>
                    </div>
                </div>

            </div>
            <div class="row">
                
                @foreach($instructors as $key=>$item)  
                @if($item->id !=2)
                <div class="col-md-3">

                    <a href="#" data-toggle="modal" data-target="#exampleModal{{$key}}">
                        <img src="{{asset('img/profiles/'.$item->photo) }}" alt="">

                        <div class="team-item_info">

                            <div class="team-item_titles">
                                <h4 class="team-title">
                                    <!--Dr. Hussni Al-Mestarihi-->
                                    {{$item->name}}
                                </h4>
                                <div class="team-department">
                                    <!--{!! Str::limit($item->detail, 200 ) !!}-->
                                    <!--Researcher & Intsructor in Human Development and Mental Health-->
                                </div>
                                <a href="#" class="read-more-btn" data-toggle="modal" data-target="#exampleModal{{$key}}">Read More
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="modal fade" id="exampleModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
        
                                <div class="row">
        
                                    <div class="col-md-3">
                                        <img src="{{asset('img/profiles/'.$item->photo) }}" alt="">
                                    </div>
        
                                    <div class="col-md-9">
        
                                        <div class="instructor-info">
                                            <h4 class="team-title">
                                                <!--Dr. Hussni Al-Mestarihi-->
                                                {{$item->name}}
                                            </h4>
                                            <div class="team-department">
                                                {!! $item->detail !!}
                                                <!--<ul>-->
                                                <!--    <li>-->
                                                <!--        Researcher & Intsructor in Human Development and Mental Health-->
                                                <!--    </li>-->
                                                <!--    <li>-->
                                                <!--        University Professor-->
                                                <!--    </li>-->
                                                <!--    <li>-->
                                                <!--        Chairman of the board of directors-->
                                                <!--    </li>-->
                                                <!--    <li>-->
                                                <!--        Author,-->
                                                <!--        <b>he has authored several books, including:</b>-->
        
                                                <!--        <ul>-->
                                                <!--            <li>-->
                                                <!--                Book ( Don't Be Afraid )-->
                                                <!--                <br>-->
                                                <!--                <small>The book guides you to ways Overcoming various fears and breaking-->
                                                <!--                    the barrier of fear-->
                                                <!--                </small>-->
                                                <!--                <a href="https://www.smashwords.com/books/view/1112136" target="_blank" class="btn btn">-->
                                                <!--                    Buy the book - PDF Format-->
                                                <!--                </a>-->
                                                <!--            </li>-->
        
                                                <!--            <li>-->
                                                <!--                Book (From Passion to Goal)-->
                                                <!--                <br>-->
                                                <!--                <small>The book guides you how to identify your talent and passion and how-->
                                                <!--                    to invest them to achieve Success-->
                                                <!--                </small>-->
                                                <!--                <a href="https://www.smashwords.com/books/view/1010475" target="_blank" class="btn btn">-->
                                                <!--                    Buy the book - PDF Format-->
                                                <!--                </a>-->
                                                <!--            </li>-->
        
                                                <!--            <li>-->
                                                <!--                Book ( My psychological state is very bad )-->
                                                <!--                <br>-->
                                                <!--                <small>-->
                                                <!--                    The book guides you through waysGet rid of the bad psychological state and reach happiness and inner peace-->
                                                <!--                </small>-->
                                                <!--                <br>-->
                                                <!--                <a href="https://www.smashwords.com/books/view/1066148" target="_blank" class="btn btn">-->
                                                <!--                    Buy the book - PDF Format-->
                                                <!--                </a>-->
                                                <!--            </li>-->
        
                                                <!--        </ul>-->
                                                <!--    </li>-->
                                                <!--</ul>-->
                                            </div>
                                        </div>
        
        
                                    </div>
        
                                </div>
        
                            </div>
        
                        </div>
                    </div>
                </div>

                @endforeach

                

            </div>
        </div>





        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-3">
                                <img src="https://elnamat.com/img/profiles/1665594843.jpeg" alt="">
                            </div>

                            <div class="col-md-9">

                                <div class="instructor-info">
                                    <h4 class="team-title">
                                        Dr. Hussni Al-Mestarihi
                                    </h4>
                                    <div class="team-department">
                                        <ul>
                                            <li>
                                                Researcher & Intsructor in Human Development and Mental Health
                                            </li>
                                            <li>
                                                University Professor
                                            </li>
                                            <li>
                                                Chairman of the board of directors
                                            </li>
                                            <li>
                                                Author,
                                                <b>he has authored several books, including:</b>

                                                <ul>
                                                    <li>
                                                        Book ( Don't Be Afraid )
                                                        <br>
                                                        <small>The book guides you to ways Overcoming various fears and breaking
                                                            the barrier of fear
                                                        </small>
                                                        <a href="https://www.smashwords.com/books/view/1112136" target="_blank" class="btn btn">
                                                            Buy the book - PDF Format
                                                        </a>
                                                    </li>

                                                    <li>
                                                        Book (From Passion to Goal)
                                                        <br>
                                                        <small>The book guides you how to identify your talent and passion and how
                                                            to invest them to achieve Success
                                                        </small>
                                                        <a href="https://www.smashwords.com/books/view/1010475" target="_blank" class="btn btn">
                                                            Buy the book - PDF Format
                                                        </a>
                                                    </li>

                                                    <li>
                                                        Book ( My psychological state is very bad )
                                                        <br>
                                                        <small>
                                                            The book guides you through waysGet rid of the bad psychological state and reach happiness and inner peace
                                                        </small>
                                                        <br>
                                                        <a href="https://www.smashwords.com/books/view/1066148" target="_blank" class="btn btn">
                                                            Buy the book - PDF Format
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </section>



@endsection