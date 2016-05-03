<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control' , 'placeholder' => 'Please provide title']) !!}
</div>
<div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
    {!! Form::textarea('body', null, ['class' => 'form-control' , 'rows' => 4 , 'cols' => 4 , 'placeholder' => 'What do you think ?']) !!} <br>

    <div class="form-group">
        {!! Form::label('tags', 'Tags', ['class' => 'control-label']) !!}
        {!! Form::select('tags[]', $tags , $tagList , ['id' => 'tag_list','class' => 'form-control' , 'multiple']) !!}
    </div>
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>

@section('footer')
    <script>
        $('#tag_list').select2({
            placeholder: "Select or add tags",
            tags: true,
            tokenSeparators: [",", " "],
            createTag: function (newTag) {
                return {
                    id: 'new:' + newTag.term,
                    text: newTag.term + ' (new)'
                };
            }
        });
    </script>
@stop