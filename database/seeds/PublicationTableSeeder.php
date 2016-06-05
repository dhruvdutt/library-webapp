<?php

use Illuminate\Database\Seeder;
use App\Publication;

class PublicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publication')->insert([
          ['isbn'=>'0385191952','title'=>'Hackers: Heroes of the Computer Revolution','author'=>'Steven Levy','publisher'=>'Doubleday'],
          ['isbn'=>'0131429019','title'=>'The Art of Unix Programming','author'=>'Eric S. Raymond','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0735619670','title'=>'Code Complete: A Practical Handbook of Software Construction','author'=>'Steve McConnell','publisher'=>'Microsoft Press'],
          ['isbn'=>'0596007124','title'=>'Head First Design Patterns','author'=>'Elisabeth Freeman','publisher'=>'O\'Reilly Media'],
          ['isbn'=>'0072850604','title'=>'Rapid Development','author'=>'Steve McConnell','publisher'=>'Microsoft Press'],
          ['isbn'=>'0201633612','title'=>'Elements of Reusable Object-Oriented Software','author'=>'Erich Gamma','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0471128457','title'=>'Applied Cryptography: Protocols, Algorithms, and Source Code in C','author'=>'Bruce Schneier','publisher'=>'Wiley'],
          ['isbn'=>'0135974445','title'=>'Agile Software Development: Principles, Patterns and Practices','author'=>'Robert C. Martin','publisher'=>'Pearson'],
          ['isbn'=>'1590593898','title'=>'Joel on Software','author'=>'Joel Spolsky','publisher'=>'Apress'],
          ['isbn'=>'0932633439','title'=>'Peopleware: Productive Projects and Teams','author'=>'Tom DeMarco, Timothy Lister','publisher'=>'Dorset House Publishing Company'],
          ['isbn'=>'0201485672','title'=>'Refactoring: Improving the Design of Existing Code','author'=>'Martin Fowler','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0131479415','title'=>'Agile Estimating and Planning','author'=>'Mike Cohn','publisher'=>'Prentice Hall'],
          ['isbn'=>'0201702258','title'=>'Writing Effective Use Cases','author'=>'Alistair Cockburn','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0136291554','title'=>'Object-Oriented Software Construction','author'=>'Bertrand Meyer','publisher'=>'Prentice Hall'],
          ['isbn'=>'0321205685','title'=>'User Stories Applied: For Agile Software Development','author'=>'Mike Cohn','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0201485419','title'=>'The Art of Computer Programming','author'=>'Donald E. Knuth','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0321127420','title'=>'Patterns of Enterprise Application Architecture','author'=>'Martin Fowler','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0596528124','title'=>'Mastering Regular Expressions','author'=>'Jeffrey Friedl','publisher'=>'O\'Reilly'],
          ['isbn'=>'020161622X','title'=>'The Pragmatic Programmer','author'=>'Andrew Hunt, David Thomas','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0735618798','title'=>'Software Requirements','author'=>'Karl E. Wiegers','publisher'=>'Microsoft Press'],
          ['isbn'=>'0131489062','title'=>'Applying UML and Patterns','author'=>'Craig Larman','publisher'=>'Prentice Hall'],
          ['isbn'=>'0321482751','title'=>'Agile Software Development','author'=>'Alistair Cockburn','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0321356705','title'=>'Software Security','author'=>'Gary McGraw','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0321200683','title'=>'Enterprise Integration Patterns','author'=>'Gregor Hohpe, Bobby Woolf','publisher'=>'Addison-Wesley'],
          ['isbn'=>'0932633390','title'=>'The Deadline: A Novel about Project Management','author'=>'Tom DeMarco','publisher'=>'Dorset House Publishing Company']
        ]);
    }
}
