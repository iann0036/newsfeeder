package nfdb.view;

import nfdb.util.*;
import java.awt.*;
import java.awt.event.ActionListener;

import javax.swing.*;
import javax.swing.border.Border;


public class LoginView extends NewsFeederView
{
	BackgroundJButton loginButton;
	JTextField usernameField;
	JPasswordField passwordField;
	JLabel errorLabel;
	
	protected void SetupBodyPanel(JPanel bodyPanel)
	{
		bodyPanel.setLayout(new BoxLayout(bodyPanel, BoxLayout.Y_AXIS));
		bodyPanel.add(Box.createVerticalGlue());
		
		//Add the pretty news feeder login label
		ImageIcon newsFeederLoginIcon = new ImageIcon(getClass().getResource("/images/LoginLogo.png"));
		JLabel newsFeederLoginLabel = new JLabel();
		newsFeederLoginLabel.setIcon(newsFeederLoginIcon);
		newsFeederLoginLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
		bodyPanel.add(newsFeederLoginLabel);
		
		//Add the login content box
		bodyPanel.add(Box.createRigidArea(new Dimension(0, 30)));
		bodyPanel.add(getLoginContentBox());
		
		//Add the error panel for login failure
		JPanel errorPanel = new JPanel();
		errorPanel.setOpaque(false);
		errorPanel.setPreferredSize(new Dimension(320, 10));
		errorLabel = new JLabel();
		errorLabel.setFont(new Font("Arial", Font.PLAIN, 12));
		errorLabel.setForeground(new Color(0xFFFFFF));
		errorPanel.add(errorLabel);
		bodyPanel.add(errorPanel);
		
		bodyPanel.add(Box.createRigidArea(new Dimension(0, 30)));
		bodyPanel.add(Box.createVerticalGlue());
	}
	
	private JPanel getLoginContentBox()
	{
		JPanel contentBoxContent = new JPanel();
		contentBoxContent.setLayout(new GridBagLayout());
		
		//Add the username label and text field
		BackgroundJPanel usernameBox = new BackgroundJPanel("/images/widgetBg.png", true);
		usernameBox.setBorder(BorderFactory.createCompoundBorder(BorderFactory.createMatteBorder(0, 0, 1, 0, new Color(0x363B3E)),BorderFactory.createCompoundBorder(BorderFactory.createMatteBorder(1, 0, 0, 0, new Color(0x24272B)), BorderFactory.createMatteBorder(0, 0, 1, 0, new Color(0x24272B)))));
		JLabel usernameLabel = new JLabel("Username:", JLabel.LEFT);
		usernameLabel.setForeground(new Color(0xD5D5D5));
		usernameLabel.setFont(new Font("Arial", Font.PLAIN, 12));
		usernameLabel.setPreferredSize(new Dimension(100, 50));
		
		usernameBox.add(usernameLabel);
		
		usernameField = new JTextField();
		usernameField.setPreferredSize(new Dimension(180, 28));
		usernameField.setBorder(BorderFactory.createEmptyBorder(0,10,0,10));
		usernameField.setBackground(new Color(0x25292B));
		usernameField.setForeground(new Color(0xD5D5D5));
		
		usernameBox.add(usernameField);
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 2;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		contentBoxContent.add(usernameBox, constraints);
		
		//Add the password label and textfield
		BackgroundJPanel passwordBox = new BackgroundJPanel("/images/widgetBg.png", true);
		passwordBox.setBorder(BorderFactory.createCompoundBorder(BorderFactory.createMatteBorder(0, 0, 1, 0, new Color(0x363B3E)),BorderFactory.createMatteBorder(0, 0, 1, 0, new Color(0x24272B))));
		JLabel passwordLabel = new JLabel("Password:", JLabel.LEFT);
		passwordLabel.setForeground(new Color(0xD5D5D5));
		passwordLabel.setFont(new Font("Arial", Font.PLAIN, 12));
		passwordLabel.setPreferredSize(new Dimension(100, 50));
		
		passwordBox.add(passwordLabel);
		
		passwordField = new JPasswordField();
		passwordField.setPreferredSize(new Dimension(180, 28));
		passwordField.setBorder(BorderFactory.createEmptyBorder(0,10,0,10));
		passwordField.setBackground(new Color(0x25292B));
		passwordField.setForeground(new Color(0xD5D5D5));
		
		passwordBox.add(passwordField);
		
		constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 3;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		contentBoxContent.add(passwordBox, constraints);
		
		//Add the login button and keep me logged in fields
		BackgroundJPanel loginButtonBox = new BackgroundJPanel("/images/widgetBg.png", true);
		JCheckBox stayLoggedIn = new JCheckBox("Keep Me Logged In");
		stayLoggedIn.setOpaque(false);
		stayLoggedIn.setSelectedIcon(new ImageIcon(getClass().getResource("/images/checkboxselected.png")));
		stayLoggedIn.setIcon(new ImageIcon(getClass().getResource("/images/checkboxunselected.png")));
		stayLoggedIn.setForeground(new Color(0xD5D5D5));
		stayLoggedIn.setFont(new Font("Arial", Font.PLAIN, 12));
		stayLoggedIn.setFocusPainted(false);
		stayLoggedIn.setPreferredSize(new Dimension(200,40));
		stayLoggedIn.setIconTextGap(10);
		
		loginButtonBox.add(stayLoggedIn);
		
		this.loginButton = new BackgroundJButton("/images/buttongradient.png", "/images/buttongradientpressed.png", "/images/buttongradienthover.png", true);
		loginButton.setText("Log Me In");
		loginButton.setForeground(new Color(0xFFFFFF));
		loginButton.setFont(new Font("Arial", Font.BOLD, 12));
		loginButton.setFocusPainted(false);
		Border innerPadding = BorderFactory.createEmptyBorder(5,15,5,15);
		Border outsideBorder = BorderFactory.createLineBorder(new Color(0x393C3D));
		Border insideBorder = BorderFactory.createLineBorder(new Color(0x292D2F)); 
		loginButton.setBorder(BorderFactory.createCompoundBorder(BorderFactory.createCompoundBorder(outsideBorder, insideBorder), innerPadding));

		loginButtonBox.add(loginButton);
		
		constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 4;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		contentBoxContent.add(loginButtonBox, constraints);
		
		ContentBoxView contentView = new ContentBoxView("Login", new ImageIcon(getClass().getResource("/images/user.png")), contentBoxContent);
		contentView.setMaximumSize(new Dimension(320, 224));
		
		return contentView;
	}
	
	public void AddLoginActionListener(ActionListener a)
	{
		this.loginButton.addActionListener(a);
	}
	
	public String GetUsername()
	{
		return usernameField.getText();
	}
	
	public String GetPassword()
	{
		return passwordField.getPassword().toString();
	}
	
	public void AuthenticationFailed()
	{
		errorLabel.setText("Login failed, check login details");
	}
}
