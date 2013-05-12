#include <iostream>
#include <cstdlib>

using namespace std;

struct yay
{
	string* i;

	yay(string* ii)
	{
		i = ii;
	}
	~yay()
	{
		if(i != NULL)
		{
			delete i;
		}
	}
};

int main()
{
	string* r = new string();

	yay* q = new yay(r);

	int* i = NULL;

	cout << i << endl;

	cout << q->i << endl;

	delete q;

	return 0;
}
