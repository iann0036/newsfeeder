/**
 * @file	AutoDB.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	14/09/12
 *
 * @section	DESCRIPTION
 *
 * Amended std::auto_ptr specified for nfdb
 * This file is created by modifying <memory> of the Stardard C++ Library
 */
 
// Copyright (C) 2001, 2002, 2004, 2005 Free Software Foundation, Inc.
//
// This file is part of the GNU ISO C++ Library.  This library is free
// software; you can redistribute it and/or modify it under the
// terms of the GNU General Public License as published by the
// Free Software Foundation; either version 2, or (at your option)
// any later version.

// This library is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License along
// with this library; see the file COPYING.  If not, write to the Free
// Software Foundation, 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301,
// USA.

// As a special exception, you may use this file as part of a free software
// library without restriction.  Specifically, if other files instantiate
// templates or use macros or inline functions from this file, or you compile
// this file and link it with other files to produce an executable, this
// file does not by itself cause the resulting executable to be covered by
// the GNU General Public License.  This exception does not however
// invalidate any other reasons why the executable file might be covered by
// the GNU General Public License.

/*
 * Copyright (c) 1997-1999
 * Silicon Graphics Computer Systems, Inc.
 *
 * Permission to use, copy, modify, distribute and sell this software
 * and its documentation for any purpose is hereby granted without fee,
 * provided that the above copyright notice appear in all copies and
 * that both that copyright notice and this permission notice appear
 * in supporting documentation.  Silicon Graphics makes no
 * representations about the suitability of this software for any
 * purpose.  It is provided "as is" without express or implied warranty.
 *
 */

#ifndef nfrd_AutoDB_h
#define nfrd_AutoDB_h

namespace nfrd { namespace misc
{
	/**
	 *  A wrapper class to provide AutoDB with reference semantics.
	 *  For example, an AutoDB can be assigned (or constructed from)
	 *  the result of a function which returns an AutoDB by value.
	 *
	 *  All the AutoDBRef stuff should happen behind the scenes.
	 */
	template<typename _Tp1>
	struct AutoDBRef
	{
		_Tp1* _M_ptr;
		
		explicit
		AutoDBRef(_Tp1* __p): _M_ptr(__p) { }
	};

	/**
	 * A class to mimic std::AutoDB specified for nfdb
	 * usage: std::AutoDB(std::vector<int *>);
	 * When out of scope, this class will deallocte the int* in the
	 * container automatically.
	 * @warning this class does not suitable for those containers which
	 *	    takes more than 1 types, such as std::map
	 * @note this class is derived from the source of std::AutoDB
	 *	 the Copyright is refer to GNU license
	 */
	template<typename _Tp>
	class AutoDB
	{
	private:
		_Tp* _M_ptr;
		
	public:
		/// The pointed-to type.
		typedef _Tp element_type;
		
		/**
		 * @brief An %AutoDB is usually constructed from a raw
		 *	  pointer.
		 * @param p	A pointer (defaults to NULL).
		 *
		 * This object now @e owns the object pointed to by @a p.
		 */
		explicit
		AutoDB(element_type* __p = 0) throw() : _M_ptr(__p) {}
		
		/**
		 * @brief An %AutoDB can be constructed from another
		 *	  %AutoDB.
		 * @param a	Another %AutoDB of the same type.
		 *
		 * This object now @e owns the object previously owned by @a a,
		 * which has given up ownsership.
		 */
		AutoDB(AutoDB& __a) throw() :
		_M_ptr(__a.release()) {}
		
		/**
		 * @brief An %AutoDB can be constructed from another
		 *	  %AutoDB.
		 * @param a	Another %AutoDB of a different but related
		 *		type.
		 *
		 * A pointer-to-Tp1 must be convertible to a
		 * pointer-to-Tp/element_type.
		 *
		 * This object now @e owns the object previously owned by @a a,
		 * which has given up ownsership.
		 */
		template<typename _Tp1>
		AutoDB(AutoDB<_Tp1>& __a) throw() :
		_M_ptr(__a.release()) {}
		
		/**
		 * @brief %AutoDB assignment operator.
		 * @param a	Another %AutoDB of the same type.
		 *
		 * This object now @e owns the object previously owned by @a a,
		 * which has given up ownsership.  The object that this one @e
		 * used to own and track has been deleted.
		 */
		AutoDB&
		operator=(AutoDB& __a) throw() {
			reset(__a.release());
			return *this;
		}
		
		/**
		 * @brief %AutoDB assignment operator.
		 * @param a	Another %AutoDB of a different but related
		 *		type.
		 *
		 * A pointer-to-Tp1 must be convertible to a
		 * pointer-to-Tp/element_type.
		 *
		 * This object now @e owns the object previously owned by @a a,
		 * which has given up ownsership.  The object that this one @e
		 * used to own and track has been deleted.
		 */
		template<typename _Tp1>
		AutoDB&
		operator=(AutoDB<_Tp1>& __a) throw() {
			reset(__a.release());
			return *this;
		}
		
		/**
		 * When the %AutoDB goes out of scope, the object it owns is
		 * deleted.  If it no longer owns anything (i.e., @c get() is
		 * @c NULL), then this has no effect.
		 *
		 * @if maint
		 * The C++ standard says there is supposed to be an empty throw
		 * specification here, but omitting it is standard conforming.
		 * Its presence can be detected only if _Tp::~_Tp() throws, but
		 * this is prohibited.  [17.4.3.6]/2
		 * @endif
		 */
		~AutoDB() {
			if (_M_ptr != 0) {
				_M_ptr->Destroy();
				delete _M_ptr;
			}
		}
		
		/**
		 * @brief Smart pointer dereferencing.
		 *
		 * If this %AutoDB no longer owns anything, then this
		 * operation will crash.  (For a smart pointer, "no longer owns
		 * anything" is the same as being a null pointer, and you know
		 * what happens when you dereference one of those...)
		 */
		element_type&
		operator*() const throw() {
			assert(_M_ptr != 0);
			return *_M_ptr;
		}
		
		/**
		 * @brief Smart pointer dereferencing.
		 *
		 * This returns the pointer itself, which the language then will
		 * automatically cause to be dereferenced.
		 */
		element_type*
		operator->() const throw() {
			assert(_M_ptr != 0);
			return _M_ptr;
		}
		
		/**
		 * @brief Bypassing the smart pointer.
		 * @return The raw pointer being managed.
		 *
		 * You can get a copy of the pointer that this object owns, for
		 * situations such as passing to a function which only accepts
		 * a raw pointer.
		 *
		 * @note This %AutoDB still owns the memory.
		 */
		element_type*
		get() const throw() { return _M_ptr; }
		
		/**
		 * @brief Bypassing the smart pointer.
		 * @return The raw pointer being managed.
		 *
		 * You can get a copy of the pointer that this object owns, for
		 * situations such as passing to a function which only accepts
		 * a raw pointer.
		 *
		 * @note This %AutoDB no longer owns the memory. When this
		 * object goes out of scope, nothing will happen.
		 */
		element_type*
		release() throw() {
			element_type* __tmp = _M_ptr;
			_M_ptr = 0;
			return __tmp;
		}
		
		/**
		 * @brief Forcibly deletes the managed object.
		 * @param p	A pointer (defaults to NULL).
		 *
		 * This object now @e owns the object pointed to by @a p. The
		 * previous object has been deleted.
		 */
		void
		reset(element_type* __p = 0) throw() {
			if (__p != _M_ptr) {
				if (_M_ptr != 0) {
					_M_ptr->Destroy();
					delete _M_ptr;
				}
				_M_ptr = __p;
			}
		}
		
		/**
		 * @brief Automatic conversions
		 *
		 * These operations convert an %AutoDB into and from an
		 * AutoDBRef automatically as needed.  This allows constructs
		 * such as
		 * @code
		 *  AutoDB<Derived>  func_returning_AutoDB(.....);
		 *  ...
		 *  AutoDB<Base> ptr = func_returning_AutoDB(.....);
		 * @endcode
		 */
		AutoDB(AutoDBRef<element_type> __ref) throw()
		: _M_ptr(__ref._M_ptr) { }
		
		AutoDB&
		operator=(AutoDBRef<element_type> __ref) throw()
		{
			if (__ref._M_ptr != this->get())
			{
				if (_M_ptr != 0) {
					_M_ptr->Destroy();
					delete _M_ptr;
				}
				_M_ptr = __ref._M_ptr;
			}
			return *this;
		}
		
		template<typename _Tp1>
		operator AutoDBRef<_Tp1>() throw()
		{ return AutoDBRef<_Tp1>(this->release()); }
		
		template<typename _Tp1>
		operator AutoDB<_Tp1>() throw()
		{ return AutoDB<_Tp1>(this->release()); }
	};
}}

#endif
