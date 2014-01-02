package gui;

import java.awt.*;
import java.awt.event.*;

import javax.swing.*;

import model.AngleCalculator;
import model.Clock;
import model.TimeValidator;

public class CustomFrame extends JFrame {

    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////
	
	private Clock clock;
	private AngleCalculator angleCalculator;
	private TimeValidator timeValidator;
	
	private JLabel labelTitle;
	private JTextField textFieldTime;
	private JLabel labelTime;
	private JButton buttonCalculate;
	private JLabel labelResultMinAngle_1;
	private JLabel labelResultMinAngle_2;
	private JLabel labelResultMaxAngle_1;
	private JLabel labelResultMaxAngle_2;

	///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////
	
	public CustomFrame() {
		this.initModel();
		this.initGui();
	}

	///////////////////////////////////////////////
    //CUSTOM GETTERS                             //
    ///////////////////////////////////////////////
	
	private String getResultMinAngleLabelText_1() {
		return "ma\u017Eiausias kampas tarp analoginio laikrod\u017Eio valandos ir";
	}
	
	private String getResultMinAngleLabelText_2(String time, String angle) {
		return "<html>minu\u010Di\u0173 rodykli\u0173, kai laikas yra  <font color='blue'>" + time + "</font>, lygus: <font color='green'>" + angle + "</font></html>";
	}
	
	private String getResultMaxAngleLabelText_1() {
		return "did\u017Eiausias kampas tarp analoginio laikrod\u017Eio valandos ir";
	}
	
	private String getResultMaxAngleLabelText_2(String time, String angle) {
		return "<html>minu\u010Di\u0173 rodykli\u0173, kai laikas yra  <font color='blue'>" + time + "</font>, lygus: <font color='red'>" + angle + "</font></html>";
	}
	
	///////////////////////////////////////////////
    //INIT                                       //
    ///////////////////////////////////////////////	
	
	private void initModel() {
		this.timeValidator = new TimeValidator();
	}
	
	private void initGui() {
		this.getContentPane().setLayout(null);
		this.setSize(new Dimension(500, 300));

		this.labelTitle = new JLabel(
				"\u012Eveskite laik\u0105 ir nuspauskite mygtuk\u0105 apskai\u010Diuoti");
		this.labelTitle.setBounds(10, 10, 300, 25);

		this.labelTime = new JLabel("Laikas");
		this.labelTime.setBounds(10, 50, 50, 25);

		this.textFieldTime = new JTextField();
		this.textFieldTime.setBounds(70, 50, 100, 25);

		this.buttonCalculate = new JButton("apskai\u010Diuoti");
		this.buttonCalculate.addActionListener(new ButtonCalculateAction());
		this.buttonCalculate.setBounds(180, 50, 120, 25);
		
		this.labelResultMinAngle_1 = new JLabel();
		this.labelResultMinAngle_1.setBounds(10, 90, 500, 25);
		
		this.labelResultMinAngle_2 = new JLabel();
		this.labelResultMinAngle_2.setBounds(10, 110, 500, 25);
		
		this.labelResultMaxAngle_1 = new JLabel();
		this.labelResultMaxAngle_1.setBounds(10, 150, 500, 25);
		
		this.labelResultMaxAngle_2 = new JLabel();
		this.labelResultMaxAngle_2.setBounds(10, 170, 500, 25);

		this.getContentPane().add(this.labelTitle);
		this.getContentPane().add(this.labelTime);
		this.getContentPane().add(this.textFieldTime);
		this.getContentPane().add(this.buttonCalculate);
		this.getContentPane().add(this.labelResultMinAngle_1);
		this.getContentPane().add(this.labelResultMinAngle_2);
		this.getContentPane().add(this.labelResultMaxAngle_1);
		this.getContentPane().add(this.labelResultMaxAngle_2);

		this.setTitle("JFrame");
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setVisible(true);
	}

	///////////////////////////////////////////////
    //ACTION LISTENERS                           //
    ///////////////////////////////////////////////	
	
	class ButtonCalculateAction implements ActionListener {
		public void actionPerformed(ActionEvent e) {
			if (timeValidator.isValid(textFieldTime.getText())) {
				clock = new Clock(textFieldTime.getText());
				angleCalculator = new AngleCalculator(clock);
				
				labelResultMinAngle_1.setText(getResultMinAngleLabelText_1());
				labelResultMinAngle_2.setText(getResultMinAngleLabelText_2(clock.getTime(), angleCalculator.getMinimumAngleBetweenClockArrowsString()));
				
				labelResultMaxAngle_1.setText(getResultMaxAngleLabelText_1());
				labelResultMaxAngle_2.setText(getResultMaxAngleLabelText_2(clock.getTime(), angleCalculator.getMaximumAngleBetweenClockArrowsString()));
			} else {
				JOptionPane.showMessageDialog(null, "Nurodykite teising\u0105 laik\u0105 (pvz.: 18:20:00)", "klaida", JOptionPane.ERROR_MESSAGE);
			}
		}	
	}
}