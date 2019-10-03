
    @foreach($files as $file)
        @if($file->expansion === 'pdf')
            <div class="files"><a class="file" href="http://agts/storage/{{$file->link}}"
                                  target="_blank">
                    <div class="file__img"><img src="/assets/icons/pdf.png"></div>
                    <div class="file__text"><span class="file__type">{{ $file->title }}</span><span
                                class="file__name">{{$file->products_name}}</span><span
                                class="file__info">PDF - {{$file->size}}</span>
                    </div>
                </a>
                @elseif($file->expansion === 'zip')
                    <div class="files"><a class="file" href="http://agts/storage/{{$file->link}}"
                                          target="_blank">
                            <div class="file__img"><img src="/assets/icons/zip.png"></div>
                            <div class="file__text"><span
                                        class="file__type">{{ $file->title }}</span><span
                                        class="file__name">{{$file->products_name}}</span><span
                                        class="file__info">ZIP - {{$file->size}}</span>
                            </div>
                        </a>
                        @else
                            <div class="files"><a class="file"
                                                  href="http://agts/storage/{{$file->link}}">
                                    <div class="file__img"><img src="/assets/icons/doc.png"></div>
                                    <div class="file__text"><span
                                                class="file__type">{{ $file->title }}</span><span
                                                class="file__name">{{$file->products_name}}</span><span
                                                class="file__info">DOC - {{$file->size}}</span>
                                    </div>
                                </a>
                                @endif
                                @endforeach
                            </div>
                    </div>
            </div>