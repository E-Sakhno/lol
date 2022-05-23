
if (!get_cookie('tz')){
    
    var timezone = (Intl.DateTimeFormat().resolvedOptions().timeZone);
    set_cookie('tz', timezone);
    
    }