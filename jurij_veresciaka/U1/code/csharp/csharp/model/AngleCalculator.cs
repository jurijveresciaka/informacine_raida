using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace csharp.model
{
    class AngleCalculator
    {
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

        public AngleCalculator(Clock clock)
        {
            this.clock = clock;
        }

        ///////////////////////////////////////////////
        //CUSTOM GETTERS                             //
        ///////////////////////////////////////////////

        public float getMinutesArrowAngle()
        {
            float angle = 0f;

            angle = this.clock.Minutes * this.minutesArrowMinutesMultiplicator;
            angle += this.clock.Seconds * this.minutesArrowSecondsMultiplicator;

            return angle;
        }

        public float getHoursArrowAngle()
        {
            float angle = 0f;

            angle = this.clock.Hours24Format * this.hoursArrowHoursMultiplicator;
            angle += this.clock.Minutes * this.hoursArrowMinutesMultiplicator;
            angle += this.clock.Seconds * this.hoursArrowSecondsMultiplicator;

            return angle;
        }

        public float getMinimumAngleBetweenClockArrowsFloat()
        {
            float angle = Math.Abs(this.getMinutesArrowAngle() - this.getHoursArrowAngle());

            if (angle >= 180.0)
            {
                angle = 360.0f - angle;
            }

            return angle;
        }

        public String getMinimumAngleBetweenClockArrowsString()
        {
            String angle = this.getMinimumAngleBetweenClockArrowsFloat().ToString();
            angle += Encoding.Unicode.GetString(Encoding.Unicode.GetBytes("\u00B0"));

            return angle;
        }

        public float getMaximumAngleBetweenClockArrowsFloat()
        {
            float angle = Math.Abs(this.getMinutesArrowAngle() - this.getHoursArrowAngle());

            if (angle < 180.0)
            {
                angle = 360.0f - angle;
            }

            return angle;
        }

        public String getMaximumAngleBetweenClockArrowsString()
        {
            String angle = this.getMaximumAngleBetweenClockArrowsFloat().ToString();
            angle += Encoding.Unicode.GetString(Encoding.Unicode.GetBytes("\u00B0"));

            return angle;
        }
    }
}
