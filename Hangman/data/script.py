import string
#write_file = open("five_letter",'w')
'''
with open('60k.words.ascii') as File:
    for line in File:
        print len(line.split()[0])
unigram_list = []
for i in range(0, 60001):
    unigram_list.append(0.0)
index = 0
with open('train.big') as File:
    for line in File:
        print index
        index += 1
        tmp = line.split()
        unigram_list[int(tmp[1])-1] += float(tmp[0])
print unigram_list

write_file = open("train.big.unigram", 'w')
index = 1
for num in unigram_list:
    write_file.write(str(index)+ " " + str(int(num)) + "\n")
    index += 1
print "done"

write_file = open('train.big.unigram.words','w')
with open('train.big.unigram') as File:
    dictionary = open('60k.words.ascii','r')
    for line1, line2 in zip(File, dictionary):
        write_file.write(line2.split()[0] + " " + line1)
print 'done'
write_file = open('words_unigram','w')
with open('train.big.unigram.words') as File:
    index = 0
    for line in File:
        good = True
        tmp = line.split()
        for char in tmp[0]:
            if char in string.punctuation:
                good = False
        if good:
            write_file.write(tmp[0] + " " + tmp[2]+"\n")
print 'done'
write_file_5 = open('5_words_unigram', 'w')
write_file_6 = open('6_words_unigram', 'w')
write_file_7 = open('7_words_unigram', 'w')
write_file_8 = open('8_words_unigram', 'w')
write_file_9 = open('9_words_unigram', 'w')
write_file_10 = open('10_words_unigram', 'w')
with open('words_unigram') as File:
    for line in File:
        tmp = line.split()
        if len(tmp[0]) == 5:
            write_file_5.write(line)
        elif len(tmp[0]) == 6:
            write_file_6.write(line)
        elif len(tmp[0]) == 7:
            write_file_7.write(line)
        elif len(tmp[0]) == 8:
            write_file_8.write(line)
        elif len(tmp[0]) == 9:
            write_file_9.write(line)
        elif len(tmp[0]) == 10:
            write_file_10.write(line)
print 'done'
'''
write_file = open('10_words.js','w')
words_str = "var words_10 = ["
counts_str = "var words_10_count =["
count = 0
with open('10_words_unigram') as File:
    for line in File:
        count += 1
with open('10_words_unigram') as File:
    index = 0
    for line in File:
        tmp = line.split()
        if index + 1 == count:
            words_str += "\"" + tmp[0] + "\"" + "];\n"
            counts_str += tmp[1] + "];\n"
        else:
            words_str += "\"" + tmp[0] + "\"" + ", "
            counts_str += tmp[1] + ", "
        index += 1
write_file.write(words_str)
write_file.write(counts_str)


