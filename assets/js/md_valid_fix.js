function md_valid_fix_string(inputid) {
        if($(inputid).val() || $(inputid).val() != 0 ) {
                $(inputid).addClass("md-valid");
        }
}
