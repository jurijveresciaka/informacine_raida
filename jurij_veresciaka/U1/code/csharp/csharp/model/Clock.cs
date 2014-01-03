using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace csharp.model
{
    class Clock
    {
        ///////////////////////////////////////////////
        //VARIABLES                                  //
        ///////////////////////////////////////////////

        private int _hours;
        private int _minutes;
        private int _seconds;

        ///////////////////////////////////////////////
        //CONSTRUCTOR                                //
        ///////////////////////////////////////////////

        public Clock(String time)
        {
            String[] timeArray = time.Split(':');

            this.Hours = Convert.ToInt32(timeArray[0]);
            this.Minutes = Convert.ToInt32(timeArray[1]);
            this.Seconds = Convert.ToInt32(timeArray[2]);
        }

        ///////////////////////////////////////////////
        //HELPERS                                    //
        ///////////////////////////////////////////////

        private String expandTimeIntToString(int timeInt)
        {
            String timeString = timeInt.ToString();

            if (timeString.Length < 2)
            {
                timeString = "0" + timeString;
            }

            return timeString;
        }

        ///////////////////////////////////////////////
        //CUTSOM GETTERS                             //
        ///////////////////////////////////////////////

        public String getTime()
        {
            String hours = this.expandTimeIntToString(this.Hours);
            String minutes = this.expandTimeIntToString(this.Minutes);
            String seconds = this.expandTimeIntToString(this.Seconds);

            String time = hours + ":" + minutes + ":" + seconds;

            return time;
        }

        ///////////////////////////////////////////////
        //ACCESSORS                                  //
        ///////////////////////////////////////////////

        public int Hours24Format
        {
            get { return _hours % 12; }
        }

        public int Hours
        {
            get { return _hours; }
            set { _hours = value; }
        }

        public int Minutes
        {
            get { return _minutes; }
            set { _minutes = value; }
        }

        public int Seconds
        {
            get { return _seconds; }
            set { _seconds = value; }
        }
    }
}
