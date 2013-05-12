#include <iostream>
using namespace std;

class A {
public:
	A() { cout << "A()" << endl; }
	virtual ~A() { cout << "~A()" << endl; }
};

class B : public A {
public:	
	B() { cout << "B()" << endl; }
	~B() { cout << "~B()" << endl; }
};

int main() {
	A* b = new B();
	delete b;

	return 0;
}
