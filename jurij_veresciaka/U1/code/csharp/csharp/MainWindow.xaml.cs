using csharp.model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace csharp
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        ///////////////////////////////////////////////
        //VARIABLES                                  //
        ///////////////////////////////////////////////

        private Clock clock;
        private AngleCalculator angleCalculator;
        private TimeValidator timeValidator;

	    ///////////////////////////////////////////////
        //CONSTRUCTOR                                //
        ///////////////////////////////////////////////

        public MainWindow()
        {
            InitializeComponent();
            initModel();
        }

	    ///////////////////////////////////////////////
        //CUSTOM GETTERS                             //
        ///////////////////////////////////////////////

        private String getResultMinAngleLabelText_1() {
		    return "mažiausias kampas tarp analoginio laikrodžio valandos ir";
	    }
	
	    private String getResultMinAngleLabelText_2(String time, String angle) {
		    return "minučių rodyklių, kai laikas yra " + time + ", lygus: " + angle;
	    }
	
	    private String getResultMaxAngleLabelText_1() {
		    return "didžiausias kampas tarp analoginio laikrodžio valandos ir";
	    }
	
	    private String getResultMaxAngleLabelText_2(String time, String angle) {
		    return "minučių rodyklių, kai laikas yra " + time + ", lygus: " + angle;
	    }

	    ///////////////////////////////////////////////
        //INIT                                       //
        ///////////////////////////////////////////////	

        private void initModel()
        {
            this.timeValidator = new TimeValidator();
        }

	    ///////////////////////////////////////////////
        //EVENT LISTENERS                            //
        ///////////////////////////////////////////////	

        private void buttonCalculate_Click(object sender, RoutedEventArgs e)
        {
            if (timeValidator.isValid(textBoxTime.Text))
            {
                this.clock = new Clock(this.textBoxTime.Text);
                this.angleCalculator = new AngleCalculator(this.clock);

                this.labelResultMinAngle_1.Content = this.getResultMinAngleLabelText_1();
                this.labelResultMinAngle_2.Content = this.getResultMinAngleLabelText_2(this.clock.getTime(), this.angleCalculator.getMinimumAngleBetweenClockArrowsString());

                this.labelResultMaxAngle_1.Content = this.getResultMaxAngleLabelText_1();
                this.labelResultMaxAngle_2.Content = this.getResultMaxAngleLabelText_2(this.clock.getTime(), this.angleCalculator.getMaximumAngleBetweenClockArrowsString());
            }
            else
            {
                MessageBox.Show("Nurodykite teisingą laiką (pvz.: 18:20:00)", "klaida", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }
    }
}
