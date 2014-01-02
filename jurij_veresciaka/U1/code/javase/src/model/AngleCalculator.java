package model;

public class AngleCalculator {

    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////
	
	private Clock clock;
	
    private float minutesArrowMinutesMultiplicator = 6.0f;
    private float minutesArrowSecondsMultiplicator = 0.1f;
    
    private float hoursArrowHoursMultiplicator = 30.0f;
    private float hoursArrowMinutesMultiplicator = 0.5f;
    private float hoursArrowSecondsMultiplicator = 30f / 3600f;
    
	///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////
    
	public AngleCalculator(Clock clock) {
		this.clock = clock;
	}
	
    ///////////////////////////////////////////////
    //CUSTOM GETTERS                             //
    ///////////////////////////////////////////////

    public float getMinutesArrowAngle()
    {
    	float angle = 0f;
    	
    	angle = this.clock.getMinutes() * this.minutesArrowMinutesMultiplicator;
    	angle += this.clock.getSeconds() * this.minutesArrowSecondsMultiplicator;

        return angle;
    }
    
    public float getHoursArrowAngle()
    {
    	float angle = 0f;
    	
    	angle = this.clock.getHours24Format() * this.hoursArrowHoursMultiplicator;
    	angle += this.clock.getMinutes() * this.hoursArrowMinutesMultiplicator;
    	angle += this.clock.getSeconds() * this.hoursArrowSecondsMultiplicator;

        return angle;
    }
    
    public float getMinimumAngleBetweenClockArrowsFloat()
    {
        float angle = Math.abs(this.getMinutesArrowAngle() - this.getHoursArrowAngle());

        if (angle >= 180.0) {
        	angle = 360.0f - angle;
        }

        return angle;
    }
    
    public String getMinimumAngleBetweenClockArrowsString()
    {
        String angle = Float.toString(this.getMinimumAngleBetweenClockArrowsFloat());
        angle += "\u00B0";

        return angle;
    }
    
    public float getMaximumAngleBetweenClockArrowsFloat()
    {
        float angle = Math.abs(this.getMinutesArrowAngle() - this.getHoursArrowAngle());

        if (angle < 180.0) {
        	angle = 360.0f - angle;
        }

        return angle;
    }
    
    public String getMaximumAngleBetweenClockArrowsString()
    {
        String angle = Float.toString(this.getMaximumAngleBetweenClockArrowsFloat());
        angle += "\u00B0";

        return angle;
    }
}
