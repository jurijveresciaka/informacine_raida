using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using csharp;

namespace csharpTest
{
    class Program
    {
        static void Main(string[] args)
        {
            printTest(
                "12/1/2013 11:59:00 PM",
                "12/2/2013 00:01:00 AM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 00:01:00 AM",
                1
             );

            printTest(
                "12/1/2013 11:59:00 PM",
                "12/3/2013 00:01:00 AM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 00:01:00 AM",
                2
             );

            printTest(
                "12/1/2013 11:59:00 PM",
                "12/5/2013 00:01:00 AM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 00:01:00 AM",
                4
             );

            printTest(
                "12/1/2013 00:00:00 AM",
                "12/1/2013 00:01:00 AM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 00:01:00 AM",
                1
             );

            printTest(
                "12/1/2013 00:00:00 AM",
                "12/1/2013 11:59:00 PM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 05:30:00 AM",
                330
             );

            printTest(
                "12/1/2013 00:00:00 AM",
                "12/2/2013 00:01:00 AM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 00:01:00 AM",
                2
             );

            printTest(
                "12/1/2013 00:00:00 AM",
                "12/1/2013 01:30:00 AM",
                "12/2/2013 01:00:00 AM",
                "12/2/2013 02:00:00 AM",
                30
             );

            printTest(
                "12/1/2013 00:00:00 AM",
                "12/10/2013 00:00:00 AM",
                "12/2/2013 00:00:00 AM",
                "12/2/2013 05:00:00 AM",
                2700
             );

            System.Console.ReadLine();
        }

        ///////////////////////////////////////////////
        //HELPERS                                    //
        ///////////////////////////////////////////////

        static void printTest(string dateStart, string dateEnd, string nightStart, string nightEnd, int expected_minutes)
        {
            DateTime _dateStart = DateTime.Parse(dateStart, System.Globalization.CultureInfo.InvariantCulture);
            DateTime _dateEnd = DateTime.Parse(dateEnd, System.Globalization.CultureInfo.InvariantCulture);
            DateTime _nightStart = DateTime.Parse(nightStart, System.Globalization.CultureInfo.InvariantCulture);
            DateTime _nightEnd = DateTime.Parse(nightEnd, System.Globalization.CultureInfo.InvariantCulture);

            System.Console.WriteLine("Date start:\t\t" + getFullDateTime(_dateStart));
            System.Console.WriteLine("Date end:\t\t" + getFullDateTime(_dateEnd));
            System.Console.WriteLine("Night start:\t\t" + getOnlyTime(_nightStart));
            System.Console.WriteLine("Night end:\t\t" + getOnlyTime(_nightEnd));
            System.Console.WriteLine("Expected minutes:\t" + expected_minutes);

            System.Console.WriteLine("Actual minutes:\t\t" + 
                TimeHelper.getNaktinisLaikas(_dateStart, _dateEnd, _nightStart, _nightEnd)
            );

            System.Console.WriteLine();
        }

        static string getFullDateTime(DateTime dateTime)
        {
            string fullDateTime = "";

            fullDateTime = getOnlyDate(dateTime) + " " + getOnlyTime(dateTime);

            return fullDateTime;
        }

        static string getOnlyDate(DateTime date)
        {
            string onlyDate = "";

            onlyDate =
                date.Year + "-" +
                expandTime(date.Month) + "-" +
                expandTime(date.Day);

            return onlyDate;
        }

        static string getOnlyTime(DateTime time)
        {
            string onlyTime = "";

            onlyTime =
                expandTime(time.Hour) + ":" +
                expandTime(time.Minute) + ":" +
                expandTime(time.Second);

            return onlyTime;
        }

        static string expandTime(int time)
        {
            string expandedTime = "";

            if (time < 10)
            {
                expandedTime = "0" + time;
            }
            else
            {
                expandedTime = "" + time;
            }

            return expandedTime;
        }
    }
}