/**
 * @file	Statistics.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	18/10/12
 *
 * @section	DESCRIPTION
 *
 * A class to periodly record and update the statistics information.
 */

#ifndef nfrd_Statistics_h
#define nfrd_Statistics_h
#include "nfrd/Module.h"

namespace nfrd { namespace module
{
	/**
	 * Periodly record and update the statistics information.
	 */
	class Statistics : public Module
	{
	public:
		/**
		 * Initialising Constructor for Statistics
		 * @param config	The config manager to use
		 * @param log	The log manager to use
		 */
		Statistics(const config::ConfigManager& config,
			   const log::LogManager& log);
		/**
		 * Delete all dynamic memory, if any
		 */
		~Statistics();
		void operator()();
		void Stop();
	private:
		/// Period of updating or recording (in seconds)
		int period;
	};
}}

#endif
