package model;

public class Clock {
	
    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////
	
	private int hours;
	private int minutes;
	private int seconds;
	
	///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////
	
	public Clock(String time) {
		String[] timeArray = time.split(":");
		
		this.setHours(Integer.parseInt(timeArray[0]));
		this.setMinutes(Integer.parseInt(timeArray[1]));
		this.setSeconds(Integer.parseInt(timeArray[2]));
	}

    ///////////////////////////////////////////////
    //HELPERS                                    //
    ///////////////////////////////////////////////

    private String expandTimeIntToString(int timeInt)
    {
    	String timeString = Integer.toString(timeInt);
    	
        if (timeString.length() < 2) {
        	timeString = "0" + timeString;
        }

        return timeString;
    }
    
    ///////////////////////////////////////////////
    //CUTSOM GETTERS                             //
    ///////////////////////////////////////////////

    public String getTime()
    {
    	String hours = this.expandTimeIntToString(this.getHours());
    	String minutes = this.expandTimeIntToString(this.getMinutes());
    	String seconds = this.expandTimeIntToString(this.getSeconds());

        String time = hours +  ":" + minutes + ":" + seconds;

        return time;
    }
	
    ///////////////////////////////////////////////
    //ACCESSORS                                  //
    ///////////////////////////////////////////////
	
	public int getHours() {
		return this.hours;
	}
	
	public int getHours24Format() {
		return (this.hours % 12);
	}

	public void setHours(int hours) {
		this.hours = hours;
	}

	public int getMinutes() {
		return this.minutes;
	}

	public void setMinutes(int minutes) {
		this.minutes = minutes;
	}

	public int getSeconds() {
		return this.seconds;
	}

	public void setSeconds(int seconds) {
		this.seconds = seconds;
	}
}
