$(document).ready(function () {
    var next = 1;
    $(".add-more").click(function (e) {
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;

        var newIn = '<div id="field' + next + '"><input autocomplete="off" class="input form-control" id="soliste' + next + '" name="soliste' + next + '" type="text" placeholder="Soprano">\n\
<input autocomplete="off" class="input form-control" id="nomsoliste' + next + '" name="nomsoliste' + next + '" type="text" placeholder="Prénom NOM" data-items="8"/></div>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source', $(addto).attr('data-source'));
        $("#count").val(next);

        $('.remove-me').click(function (e) {
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length - 1);
            var fieldID = "#field" + fieldNum;
            var solistID = "#nomsoliste" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
            $(solistID).remove();
        });
    });



});
$(document).ready(function () {
    var next = 1;
    $(".add-more-musician").click(function (e) {
        e.preventDefault();
        console.log(0);
        var addto = "#musician" + next;
        var addRemove = "#musician" + (next);
        next = next + 1;

        var newIn = '<div id="musician' + next + '"><input autocomplete="off" class="input form-control" id="musicien' + next + '" name="musicien' + next + '" type="text" placeholder="Piano">\n\
<input autocomplete="off" class="input form-control" id="nommusicien' + next + '" name="nommusicien' + next + '" type="text" placeholder="Prénom NOM" data-items="8"/></div>';
        var newInput = $(newIn);
        var removeBtn = '<button id="rm' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#musician" + next).attr('data-source', $(addto).attr('data-source'));
        $("#counter").val(next);

        $('.remove-me').click(function (e) {
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length - 1);
            var fieldID = "#musicien" + fieldNum;
            var solistID = "#nommusicien" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
            $(solistID).remove();
        });
    });



});