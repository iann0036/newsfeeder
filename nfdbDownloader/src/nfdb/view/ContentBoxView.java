package nfdb.view;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;

import javax.swing.BorderFactory;
import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import javax.swing.JPanel;

import nfdb.util.BackgroundJPanel;

public class ContentBoxView extends JPanel
{
	private String title;
	private Icon titleIcon;
	private JPanel content;
	
	public ContentBoxView(String title, Icon titleIcon, JPanel content)
	{
		this.title = title;
		this.titleIcon = titleIcon;
		this.content = content;
		
		setupContentBox();
	}
	
	private void setupContentBox()
	{
		this.setBorder(BorderFactory.createCompoundBorder(BorderFactory.createMatteBorder(0, 0, 1, 0, new Color(0x4B4E50)), BorderFactory.createCompoundBorder(BorderFactory.createMatteBorder(0, 1, 1, 1, new Color(0x2A2E34)), BorderFactory.createMatteBorder(1, 0, 0, 0, new Color(0x24272B)))));
		this.setMaximumSize(new Dimension(320, Integer.MAX_VALUE));
		this.setLayout(new GridBagLayout());
		
		//Add the heading to the content area
		BackgroundJPanel contentHeading = new BackgroundJPanel("/images/titleBg.png", true);
		contentHeading.setTopBorderOffset(2);
		contentHeading.setLayout(new GridBagLayout());
				
		JLabel headingLabel = new JLabel(this.title, this.titleIcon, JLabel.LEFT);
		headingLabel.setIconTextGap(8);
		headingLabel.setForeground(new Color(0xFAFAFA));
		headingLabel.setFont(new Font("Cuprum", Font.PLAIN, 15));
		headingLabel.setPreferredSize(new Dimension(200, 38));
		headingLabel.setBorder(BorderFactory.createEmptyBorder(0,10,0,0));
		
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 1;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		contentHeading.add(headingLabel, constraints);
		
		constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 1;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		this.add(contentHeading, constraints);
		
		//Add the content to the content box
		constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 2;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		this.add(content, constraints);
	}
}
