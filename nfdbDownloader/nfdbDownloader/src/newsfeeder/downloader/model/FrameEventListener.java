package newsfeeder.downloader.model;

import java.util.EventListener;
import java.util.EventObject;
import javax.swing.event.EventListenerList;

public class FrameEventListener 
{
	private EventListenerList listenerList;
	
	public FrameEventListener()
	{
		this.listenerList = new EventListenerList();
	}

	void addClickListener(FrameResizeListener l)
	{
		listenerList.add(FrameResizeListener.class, l);
	}
	
	void removeClickListener(FrameResizeListener l)
	{
		listenerList.remove(FrameResizeListener.class, l);
	}

	protected void fireClicked(FrameResizeEvent e)
	{
		FrameResizeListener[] ls = listenerList.getListeners(FrameResizeListener.class);
		for (FrameResizeListener l : ls)
		{
			l.clicked(e);
		}
	}
	  
	class FrameResizeEvent extends EventObject 
	{
		public FrameResizeEvent(Object source)
		{
			super(source);
		}
	}
	  
	interface FrameResizeListener extends EventListener
	{
		void clicked(FrameResizeEvent e);
	} 
}


