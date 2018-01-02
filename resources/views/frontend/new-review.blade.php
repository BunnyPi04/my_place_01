@extends('frontend.master')
@section('head-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#searchText").keyup(function(){
            var key = $("#searchText").val();
            var searchURL = '{{asset('/getplaces?key=')}}' + key;
            $.getJSON(searchURL, function(data) {
                var text = '<ul>';
                console.log(data);
                data.forEach(function(d) {
                    text += `<li onclick="selectPlace('${d.name}')"> ${d.name} </li>`;
                });
                text += '</ul>';
                $('#suggesstion-box').html(text);
            });
        });
    });
    //To select country name
    function selectPlace(val) {
        console.log('sss');
        $("#searchText").val(val);
        $("#suggesstion-box").hide();
    }
</script>
@stop
@section('main')
<div class="block">
    {{-- open form --}}
        <div id="error_explanation">
            <h2>
               {{ trans('messages.create-review') }}
            </h2>
        </div>
        <div class="field">
            <label>{{ trans('messages.place') }}</label>
            <input type="text" id="searchText">
            <div id="suggesstion-box"></div>
        </div>
        <div class="field">
            <label>{{ trans('messages.short-description') }}</label>
            <input type="text" name="title" id="submary">
        </div>
        <div class="field">
            <label>{{ trans('messages.your-review') }}</label>
            <textarea name="content" id="idea_description"></textarea>
        </div>
        <div class="field">
            <label>{{ trans('messages.date-visit') }}</label>
            <input type="date" name="time">
        </div>
        <div class="field">
            <label>{{ trans('messages.your-rate') }}</label>
            <section class='rating-widget'>
                <table>
                    <tr>
                        <td>{{ trans('messages.service') }}</td>
                        <td>
                            <div class='rating-stars'>
                            <ul class='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans('messages.quality') }}</td>
                        <td>
                            <div class='rating-stars'>
                            <ul class='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                </table>
            </section>
        </div>
        <div class="field">
            <label>{{ trans('messages.choose-img') }}</label>
            <div id="filediv">
                <input name="file[]" type="file" id="file"/>
            </div>
        </div>
        <div class="row actions">
            <input type="button" id="addScnt" class="upload btn btn-primary btn2 col-md-3" value="{{ trans('messages.add-img') }}"/>
            <input type="submit" value="Upload File" name="submit" id="upload" class="upload btn btn-primary btn2 col-md-3"/>
        </div>
    {{-- endform --}}
</div>
<script type="text/javascript">
$(document).ready(function(){
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('.stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
          if (e < onStar) {
            $(this).addClass('hover');
          }
          else {
            $(this).removeClass('hover');
            }
        });
    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });  
    /* 2. Action to perform on click */
    $('.stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }        
        var ratingValue = parseInt($('.stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);
    });
    $('#addScnt').click(function() {
            $(this).before($("<div/>", {
                id: 'filediv'
            }).fadeIn('slow').append($("<input/>", {
                name: 'file[]',
                type: 'file',
                id: 'file'
            }), $("<br/><br/>")));
        });
});
    var abc = 0;// Declaring and defining global increment variable.
    $(document).ready(function() {
        // Following function will executes on change event of file input to select different file.
        $('body').on('change', '#file', function() {
            if (this.files && this.files[0]) {
                abc += 1; // Incrementing global variable by 1.
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/><br /></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd" + abc).append($('<img src="x.png" alt="Delete"/><br/>').click(function() {
                    $(this).parent().parent().remove();
                }));
            }
        });
        // To Preview Image
        function imageIsLoaded(e) {
            $('#previewimg' + abc).attr('src', e.target.result);
        };
        $('#upload').click(function(e) {
            var name = $(":file").val();
            if (!name) {
                alert("First Image Must Be Selected");
            e.preventDefault();
        }
        });
    });
</script>
<style type="text/css">
    #filediv, .abcd, .abcd img {
        width: 100%;
    }
</style>
@stop