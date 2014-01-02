package model;

import java.util.regex.*;

public class TimeValidator {
    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////

    private String regex = "([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]";

	///////////////////////////////////////////////
    //VALIDATOR                                  //
    ///////////////////////////////////////////////
    
    public boolean isValid(String time)
    {
        boolean isValid = false;

        Pattern pattern = Pattern.compile(this.regex);
        Matcher matcher = pattern.matcher(time);
     
        if (matcher.matches()) {
        	isValid = true;
        } else {
        	isValid = false;
        }

        return isValid;
    }
}
