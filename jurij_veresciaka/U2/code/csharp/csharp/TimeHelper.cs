using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace csharp
{
    public class TimeHelper
    {
        public static int getNaktinisLaikas(DateTime dateStart, DateTime dateEnd, DateTime nightStart, DateTime nightEnd)
        {
            ///////////////////////////////////////////////
            //CHECK VALUES                               //
            ///////////////////////////////////////////////

            if (DateTime.Compare(dateStart, dateEnd) >= 0)
            {
                throw new System.ArgumentException("!(dateStart < dateEnd)", "dateStart, dateEnd");
            }

            if (DateTime.Compare(nightStart, nightEnd) >= 0)
            {
                throw new System.ArgumentException("!(nightStart < nightEnd)", "nightStart, nightEnd");
            }

            ///////////////////////////////////////////////
            //LOGIC                                      //
            ///////////////////////////////////////////////

            System.TimeSpan totalDays = dateEnd.Subtract(dateStart);

            bool isDaysTheSame = false;

            if (DateTime.Compare(
                new DateTime(dateStart.Year, dateStart.Month, dateStart.Day),
                new DateTime(dateEnd.Year, dateEnd.Month, dateEnd.Day)
                ) == 0)
            {
                isDaysTheSame = true;
            }

            int nightMinutes = 0;

            if (isDaysTheSame) {
                nightMinutes += getNightMinutesPerDay(dateStart, dateEnd, nightStart, nightEnd);
            }
            else
            {
                nightMinutes += getNightMinutesPerDay(dateStart, new DateTime(dateEnd.Year, dateEnd.Month, dateEnd.Day, 23, 59, 0), nightStart, nightEnd);
                nightMinutes += getNightMinutesPerDay(new DateTime(dateStart.Year, dateStart.Month, dateStart.Day, 0, 0, 0), dateEnd, nightStart, nightEnd);
            }

            int nightTotal = getMinutesFromTime(nightEnd) - getMinutesFromTime(nightStart);

            if (totalDays.Days > 0) {
                if (getMinutesFromTime(dateEnd) >= getMinutesFromTime(dateStart)) {
                    nightMinutes += (totalDays.Days - 1) * nightTotal;
                } else {
                    nightMinutes += totalDays.Days * nightTotal;
                }
            }

            return nightMinutes;
        }

        ///////////////////////////////////////////////
        //HELPERS                                    //
        ///////////////////////////////////////////////

        public static int getNightMinutesPerDay(DateTime dayStart, DateTime dayEnd, DateTime nightStart, DateTime nightEnd)
        {
            ///////////////////////////////////////////////
            //CHECK VALUES                               //
            ///////////////////////////////////////////////

            if (DateTime.Compare(dayStart, dayEnd) > 0)
            {
                throw new System.ArgumentException("!(dayStart <= dayStart)", "dayStart, dayEnd");
            }

            if (DateTime.Compare(nightStart, nightEnd) >= 0)
            {
                throw new System.ArgumentException("!(nightStart < nightEnd)", "nightStart, nightEnd");
            }

            ///////////////////////////////////////////////
            //LOGIC                                      //
            ///////////////////////////////////////////////

            int dayStartMinutes = getMinutesFromTime(dayStart);
            int dayEndMinutes = getMinutesFromTime(dayEnd);
            int nightStartMinutes = getMinutesFromTime(nightStart);
            int nightEndMinutes = getMinutesFromTime(nightEnd);

            int dayTotalMinutes = dayEndMinutes - dayStartMinutes;
            int nightTotalMinutes = nightEndMinutes - nightStartMinutes;

            // day   /--/     ||      /--/
            // night     /--/ || /--/
            if ((dayEndMinutes <= nightStartMinutes) || (dayStartMinutes >= nightEndMinutes)) {
                return 0;
            }
            // day   /-----/
            // night  /--/
            if ((dayStartMinutes <= nightStartMinutes) && (dayEndMinutes >= nightEndMinutes)) {
                return nightTotalMinutes;
            }
            // day     /--/
            // night /-----/
            if ((dayStartMinutes >= nightStartMinutes) && (dayEndMinutes <= nightEndMinutes)) {
                return dayTotalMinutes;
            }
            // day    /-----/    || /-----/
            // night     /-----/ || /--------/
            if ((dayStartMinutes <= nightStartMinutes) && (dayEndMinutes < nightEndMinutes)) {
                return dayEndMinutes - nightStartMinutes;
            }
            // day       /-----/ ||    /-----/
            // night  /-----/    || /--------/
            if ((dayStartMinutes > nightStartMinutes) && (dayEndMinutes >= nightEndMinutes)) {
                return nightEndMinutes - dayStartMinutes;
            }

            return 0;
        }


        private static int getMinutesFromTime(DateTime time)
        {
            ///////////////////////////////////////////////
            //LOGIC                                      //
            ///////////////////////////////////////////////

            int hours = time.Hour;
            int minutes = time.Minute;

            minutes = hours * 60 + minutes;
        
            return minutes;
        }
    }
}
