using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Text.RegularExpressions;

namespace csharp.model
{
    class TimeValidator
    {
        ///////////////////////////////////////////////
        //VARIABLES                                  //
        ///////////////////////////////////////////////

        private String regex_pattern = @"([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]";

        ///////////////////////////////////////////////
        //VALIDATOR                                  //
        ///////////////////////////////////////////////

        public bool isValid(String time)
        {
            bool isValid = false;

            Regex regex = new Regex(this.regex_pattern, RegexOptions.IgnoreCase);
            Match match = regex.Match(time);

            if (match.Success)
            {
                isValid = true;
            }
            else
            {
                isValid = false;
            }

            return isValid;
        }
    }
}
