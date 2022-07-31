<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="far fa-comment-dots fa-lg"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">تالار گفت و گو</h3>
                </div>
                <div class="box-body">
                    @php
                        $chats = App\Models\Chat::all();
                    @endphp

                        <div class="direct-chat-messages">

                            @foreach ($chats as $chat)
                                @php
                                    $user = App\Models\User::where('id',$chat->from_id)->first();
                                @endphp
                                @if ($chat->from_id == $authUser->id)
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">{{ $user->name }}</span>
                                        <span class="direct-chat-timestamp pull-left">{{ verta($chat->created_at) }}</span>
                                    </div>
                                    <img class="direct-chat-img" src="@php
                                        if($authUser->avatar == null){
                                            echo '/img/2730042.png';
                                        }
                                        elseif($authUser->provider == 'google'){
                                            echo $authUser->avatar;
                                        }else{
                                            echo $authUser->avatar;
                                        }
                                        @endphp"
                                        alt="message user image">
                                    <div class="direct-chat-text" style="margin: 5px 50px 0 5px;">
                                        {{ $chat->description }}
                                    </div>
                                </div>
                                @else
                                <div class="direct-chat-msg">

                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-timestamp pull-right">{{ verta($chat->created_at) }}</span>
                                        <span class="direct-chat-name pull-left">{{ $user->name }}</span>
                                    </div>
                                    <img class="direct-chat-img" style="float:left;" src="@php
                                        if($user->avatar == null){
                                            echo '/img/2730042.png';
                                        }
                                        elseif($user->provider == 'google'){
                                            echo $user->avatar;
                                        }else{
                                            echo $user->avatar;
                                        }
                                        @endphp"
                                        alt="message user image">
                                    <div class="direct-chat-text" style="margin: 5px 5px 0 50px;">
                                        {{ $chat->description }}
                                    </div>

                                </div>
                                @endif
                            @endforeach

                        </div>

                </div>
                <div class="box-footer">
                    <form name="contact" action="" >
                        <div class="input-group">
                            <input type="text" name="message" id="message" size="30" value="" class="text-input form-control" />

                            <span class="input-group-btn">
                            <input type="submit" name="submit" class="button btn btn-warning btn-flat" id="submit_btn" value="ارسال" />
                            </span>
                            <input type="text" name="send_message" value="true" hidden>
                        </div>
                    </form>

                </div>
            </div>
        </li>
    </ul>
</li>
