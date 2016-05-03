$(document).ready(function () {
    $('.confirm').on('click', function (e) {
        if (confirm($(this).data('confirm'))) {
            return true;
        }
        else {
            return false;
        }
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});

function deleteComment(commentId) {
    if (confirm("Are You Sure ?")) {

        $.ajax({
            url: "/comment/" + commentId,
            type: 'DELETE',
            success: function (data) {
                console.log(data);
                $('#commentSection').load(document.URL + ' #commentSection');

            }
        });
    }
    return false;

}


function makeEditable(commentId) {
    console.log("editing" + commentId);
    var commentContent = $('#commentcontents-' + commentId);
    commentContent.css("background", "#FFF");
    commentContent.css("min-height", "40px");
    commentContent.attr('contenteditable', true);
    commentContent.focus();
}

function saveToDatabase(commentId, updates) {

    if (updates === "") {
        alert('it cant be empty');
    }

    if (updates != "") {
        $.ajax({
            url: "/comment/" + commentId,
            type: "PATCH",
            data: {contents: updates},
            success: function (data) {
                console.log(data);
            }

        });
        $('#commentcontents-' + commentId).attr('contenteditable', false);
    }
    else {
        return false;
    }
    $('#commentSection').load(document.URL + ' #commentSection');


}

function updateContents(e, id, html) {
    if (e.keyCode == 13) {
        if (!e.shiftKey === true) {
            saveToDatabase(id, html);
        }
        return false;

    }
}
